$(function() {
    let removedList = [];
    function split( val ) {
        return val.split( /,\s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
    }
    
    $( "#skills" ).bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
            event.preventDefault();
        }
    })
    .autocomplete({
        minLength: 1,
        source: function( request, response ) {
            let sizeArr = availableTags.length;
            let result = []
            for (let i = 0; i < sizeArr; i++) {
                if (availableTags[i].toLowerCase().indexOf(extractLast( request.term )) !== -1){
                    result.push(availableTags[i])
                }
            }
            let sizeRem = result.length;
            for(let j = 0; j < sizeRem; j++) {
                for(let k = 0; k < removedList.length; k++) {
                    if(result[j] === removedList[k]){
                        result.splice(j, 1);
                    }
                }
            }
            response((result));
            
        },
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
        select: function( event, ui ) {
            var terms = split( this.value );
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push( ui.item.value );
            removedList.push( ui.item.value );
            // add placeholder to get the comma-and-space at the end
            terms.push( "" );
            this.value = terms.join( ", " );
            return false;
        },
        change: function ( event, ui ) {
            let sizeArr = availableTags.length;
            let corect = 0;
            var terms = split(this.value, ", " );
            for(let i = 0; i < terms.length; i++)
                if( $.inArray( terms[i], availableTags) === -1 ) {
                    terms.splice(i, 1);
                    i--;
                }
            for(let i = 0; i < removedList.length; i++) {
                if( $.inArray( removedList[i], terms) === -1 ) {
                    removedList.splice(i, 1);
                    i--;
                }
            }
            this.value = terms.join(", ");
         }
    });
});



$(function() {

    let removedList = [];
    function split( val ) {
        return val.split( /,\s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
    }
    
    $( "#observers" ).bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
            event.preventDefault();
        }
    })
    .autocomplete({
        minLength: 1,
        source: function( request, response ) {
            let sizeArr = availableTags.length;
            let result = []
            for (let i = 0; i < sizeArr; i++) {
                if (availableTags[i].toLowerCase().indexOf(extractLast( request.term )) !== -1){
                    result.push(availableTags[i])
                }
            }
            let sizeRem = result.length;
            for(let j = 0; j < sizeRem; j++) {
                for(let k = 0; k < removedList.length; k++) {
                    if(result[j] === removedList[k]){
                        result.splice(j, 1);
                    }
                }
            }
            response((result));
            
        },
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
        select: function( event, ui ) {
            var terms = split( this.value );
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push( ui.item.value );
            removedList.push( ui.item.value );
            // add placeholder to get the comma-and-space at the end
            terms.push( "" );
            this.value = terms.join( ", " );
            return false;
        },
        change: function ( event, ui ) {
            let sizeArr = availableTags.length;
            let corect = 0;
            var terms = split(this.value, ", " );
            for(let i = 0; i < terms.length; i++)
                if( $.inArray( terms[i], availableTags) === -1 ) {
                    terms.splice(i, 1);
                    i--;
                }
            for(let i = 0; i < removedList.length; i++) {
                if( $.inArray( removedList[i], terms) === -1 ) {
                    removedList.splice(i, 1);
                    i--;
                }
            }
            this.value = terms.join(", ");
         }
    });
});