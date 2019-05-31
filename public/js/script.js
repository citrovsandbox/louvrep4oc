function scrollTo( target ) {
    if( target.length ) {
        $("html, body").stop().animate( { scrollTop: target.offset().top }, 800);
    }
}
function onLearnMorePress () {
    console.log("triggered");
    scrollTo($('#prices_table_container'))
}