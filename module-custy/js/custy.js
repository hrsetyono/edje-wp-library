/**
 *  
 */
function custyFormatBackgroundSync( option ) {

  /**
   *  
   */
  function addPrefix( value, prefix = '' ) {
    if (prefix.trim() === '') {
      return value;
    }
    return `${prefix}${value.charAt(0).toUpperCase()}${value.slice(1)}`;
  }

  /**
   *  
   */
  function getBackgroundUrl( e ) {
    var t = e.background_type,
        r = e.background_image,
        o = e.background_pattern,
        n = e.patternColor,
        c = e.backgroundColor;

    if ("color" === t) return "CT_CSS_SKIP_RULE" !== c.default.color ? "none" : "CT_CSS_SKIP_RULE";
    
    var i = function(e, t, r) {
      return (r + "").split(e).join(t)
    };

    if ("image" === t) return r.url ? "url(".concat(r.url, ")") : "CT_CSS_SKIP_RULE";
    
    var s = 1,
      l = n.default.color;
    (
      l.indexOf("var(--main)") > -1 && (l = getComputedStyle(document.body).getPropertyValue("--main")),
      l.indexOf("var(--mainDark)") > -1 && (l = getComputedStyle(document.body).getPropertyValue("--mainDark")),
      l.indexOf("var(--mainLight)") > -1 && (l = getComputedStyle(document.body).getPropertyValue("--mainLight")),
      l.indexOf("var(--sub)") > -1 && (l = getComputedStyle(document.body).getPropertyValue("--sub")),
      l.indexOf("var(--subLight)") > -1 && (l = getComputedStyle(document.body).getPropertyValue("--subLight")),
      l.indexOf("var(--text)") > -1 && (l = getComputedStyle(document.body).getPropertyValue("--text")),
      l.indexOf("var(--textInvert)") > -1 && (l = getComputedStyle(document.body).getPropertyValue("--textInvert"))
    );

    l = l.trim();
    
    if( l.indexOf("rgb") > -1 ) {
      var u = i("rgb(", "", i(")", "", i("rgba(", "", i(" ", "", l)))).split(",");
      l = "#".concat(a(parseInt(u[0], 10))).concat(a(parseInt(u[1], 10))).concat(a(parseInt(u[2], 10))), u.length > 3 && (s = u[3])
    }

    return l = i("#", "", l), 'url("'.concat(i("OPACITY", s, i("COLOR", l, ct_localizations.customizer_sync.svg_patterns[o] || ct_localizations.customizer_sync.svg_patterns["type-1"])), '")')
  };
}