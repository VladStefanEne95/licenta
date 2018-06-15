let msg = 0;
$("#iframe").on("load", function () {
    let iframe = document.getElementById("iframe");
    iframe.contentWindow.scrollTo( 0, 999999 );
    $('#iframe').contents().find('#sendMessage').click(function(){
        msg = 1;
    })
    $('#iframe').contents().find('#chatInput').keyup(function(event){
        if (event.keyCode === 13) {
            msg = 1;
        }
    })
    setInterval(function(){
        if( msg == 1) {
            let iframe = document.getElementById("iframe");
            iframe.contentWindow.scrollTo( 0, 999999 );
            msg = 0;
        }
     },500)
});
