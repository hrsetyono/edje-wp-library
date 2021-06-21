export default {
  /**
   * Simple GET and POST functions that return Promise.
   * 
   * Example:
   *   API.get( url ).then( result => { .. } );
   *   API.post( url, data ).then( result => { ... } );
   */
  API: {
    get( endpoint, args = {} ) {
      return window.fetch( endpoint, {
        method: 'GET',
        headers: { 'Accept': 'application/json' },
        ...args
      } )
      .then( this._handleError )
      .then( this._handleContentType )
      .catch( this._throwError );
    },

    post( endpoint, body, args = {} ) {
      return window.fetch( endpoint, {
        method: 'POST',
        headers: { 'content-type': 'application/json' },
        body: JSON.stringify( body ),
        ...args
      } )
      .then( this._handleError )
      .then( this._handleContentType )
      .catch( this._throwError );
    },

    _handleError( err ) {
      return err.ok ? err : Promise.reject( err.statusText )
    },

    _handleContentType( res ) {
      const contentType = res.headers.get( 'content-type' );

      if( contentType && contentType.includes( 'application/json' ) ) {
        return res.json();
      }
      else if( contentType && contentType.includes( 'image/svg+xml' ) ) {
        return Promise.resolve( res.text() );
      }

      return Promise.reject( 'Oops, we haven\'t got JSON!' );
    },

    _throwError( err ) {
      throw new Error( err );
    }
  },

};