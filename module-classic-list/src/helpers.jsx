const LINE_SEPARATOR = '\u2028';

function getLineIndex( { start, text }, startIndex = start ) {
  let index = startIndex;

  while ( index-- ) {
    if ( text[ index ] === LINE_SEPARATOR ) {
      return index;
    }
  }
}

/**
 * INDENT
 */
export function canIndentListItems( value ) {
  const lineIndex = getLineIndex( value );

  // There is only one line, so the line cannot be indented.
  if ( lineIndex === undefined ) {
    return false;
  }

  const { replacements } = value;
  const previousLineIndex = getLineIndex( value, lineIndex );
  const formatsAtLineIndex = replacements[ lineIndex ] || [];
  const formatsAtPreviousLineIndex = replacements[ previousLineIndex ] || [];

  // If the indentation of the current line is greater than previous line,
  // then the line cannot be furter indented.
  return formatsAtLineIndex.length <= formatsAtPreviousLineIndex.length;
}

function getTargetLevelLineIndex( { text, replacements }, lineIndex ) {
  const startFormats = replacements[ lineIndex ] || [];

  let index = lineIndex;

  while ( index-- >= 0 ) {
    if ( text[ index ] !== LINE_SEPARATOR ) {
      continue;
    }

    const formatsAtIndex = replacements[ index ] || [];

    // Return the first line index that is one level higher. If the level is
    // lower or equal, there is no result.
    if ( formatsAtIndex.length === startFormats.length + 1 ) {
      return index;
    } else if ( formatsAtIndex.length <= startFormats.length ) {
      return;
    }
  }
}

/**
 * Indents any selected list items if possible.
 *
 * @param {RichTextValue}  value      Value to change.
 * @param {RichTextFormat} rootFormat Root format.
 *
 * @return {RichTextValue} The changed value.
 */
export function indentListItems( value, rootFormat ) {
  if ( ! canIndentListItems( value ) ) {
    return value;
  }

  const lineIndex = getLineIndex( value );
  const previousLineIndex = getLineIndex( value, lineIndex );
  const { text, replacements, end } = value;
  const newFormats = replacements.slice();
  const targetLevelLineIndex = getTargetLevelLineIndex( value, lineIndex );

  for ( let index = lineIndex; index < end; index++ ) {
    if ( text[ index ] !== LINE_SEPARATOR ) {
      continue;
    }

    // Get the previous list, and if there's a child list, take over the
    // formats. If not, duplicate the last level and create a new level.
    if ( targetLevelLineIndex ) {
      const targetFormats = replacements[ targetLevelLineIndex ] || [];
      newFormats[ index ] = targetFormats.concat(
        ( newFormats[ index ] || [] ).slice( targetFormats.length - 1 )
      );
    } else {
      const targetFormats = replacements[ previousLineIndex ] || [];
      const lastformat =
        targetFormats[ targetFormats.length - 1 ] || rootFormat;

      newFormats[ index ] = targetFormats.concat(
        [ lastformat ],
        ( newFormats[ index ] || [] ).slice( targetFormats.length )
      );
    }
  }

  return {
    ...value,
    replacements: newFormats,
  };
}

/**
 * OUTDENT
 */
export function canOutdentListItems( value ) {
  const { replacements, start } = value;
  const startingLineIndex = getLineIndex( value, start );
  return replacements[ startingLineIndex ] !== undefined;
}

function getParentLineIndex( { text, replacements }, lineIndex ) {
  const startFormats = replacements[ lineIndex ] || [];

  let index = lineIndex;

  while ( index-- >= 0 ) {
    if ( text[ index ] !== LINE_SEPARATOR ) {
      continue;
    }

    const formatsAtIndex = replacements[ index ] || [];

    if ( formatsAtIndex.length === startFormats.length - 1 ) {
      return index;
    }
  }
}

export function getLastChildIndex( { text, replacements }, lineIndex ) {
  const lineFormats = replacements[ lineIndex ] || [];
  // Use the given line index in case there are no next children.
  let childIndex = lineIndex;

  // `lineIndex` could be `undefined` if it's the first line.
  for ( let index = lineIndex || 0; index < text.length; index++ ) {
    // We're only interested in line indices.
    if ( text[ index ] !== LINE_SEPARATOR ) {
      continue;
    }

    const formatsAtIndex = replacements[ index ] || [];

    // If the amout of formats is equal or more, store it, then return the
    // last one if the amount of formats is less.
    if ( formatsAtIndex.length >= lineFormats.length ) {
      childIndex = index;
    } else {
      return childIndex;
    }
  }

  // If the end of the text is reached, return the last child index.
  return childIndex;
}


export function outdentListItems( value ) {
  if ( ! canOutdentListItems( value ) ) {
    return value;
  }

  const { text, replacements, start, end } = value;
  const startingLineIndex = getLineIndex( value, start );
  const newFormats = replacements.slice( 0 );
  const parentFormats =
    replacements[ getParentLineIndex( value, startingLineIndex ) ] || [];
  const endingLineIndex = getLineIndex( value, end );
  const lastChildIndex = getLastChildIndex( value, endingLineIndex );

  // Outdent all list items from the starting line index until the last child
  // index of the ending list. All children of the ending list need to be
  // outdented, otherwise they'll be orphaned.
  for ( let index = startingLineIndex; index <= lastChildIndex; index++ ) {
    // Skip indices that are not line separators.
    if ( text[ index ] !== LINE_SEPARATOR ) {
      continue;
    }

    // In the case of level 0, the formats at the index are undefined.
    const currentFormats = newFormats[ index ] || [];

    // Omit the indentation level where the selection starts.
    newFormats[ index ] = parentFormats.concat(
      currentFormats.slice( parentFormats.length + 1 )
    );

    if ( newFormats[ index ].length === 0 ) {
      delete newFormats[ index ];
    }
  }

  return {
    ...value,
    replacements: newFormats,
  };
}

/**
 * ACTIVE LIST
 */
export function isActiveListType( value, type, rootType ) {
  const { replacements, start } = value;
  const lineIndex = getLineIndex( value, start );
  const replacement = replacements[ lineIndex ];

  if ( ! replacement || replacement.length === 0 ) {
    return type === rootType;
  }

  const lastFormat = replacement[ replacement.length - 1 ];

  return lastFormat.type === type;
}

/**
 * CHANGE LIST TYPE
 */
export function changeListType( value, newFormat ) {
  const { text, replacements, start, end } = value;
  const startingLineIndex = getLineIndex( value, start );
  const startLineFormats = replacements[ startingLineIndex ] || [];
  const endLineFormats = replacements[ getLineIndex( value, end ) ] || [];
  const startIndex = getParentLineIndex( value, startingLineIndex );
  const newReplacements = replacements.slice();
  const startCount = startLineFormats.length - 1;
  const endCount = endLineFormats.length - 1;

  let changed;

  for ( let index = startIndex + 1 || 0; index < text.length; index++ ) {
    if ( text[ index ] !== LINE_SEPARATOR ) {
      continue;
    }

    if ( ( newReplacements[ index ] || [] ).length <= startCount ) {
      break;
    }

    if ( ! newReplacements[ index ] ) {
      continue;
    }

    changed = true;
    newReplacements[ index ] = newReplacements[ index ].map(
      ( format, i ) => {
        return i < startCount || i > endCount ? format : newFormat;
      }
    );
  }

  if ( ! changed ) {
    return value;
  }

  return {
    ...value,
    replacements: newReplacements,
  };
}

/**
 * IS LIST ROOT SELECTED
 */
export function isListRootSelected( value ) {
  const { replacements, start } = value;
  const lineIndex = getLineIndex( value, start );
  const replacement = replacements[ lineIndex ];

  return ! replacement || replacement.length < 1;
}
