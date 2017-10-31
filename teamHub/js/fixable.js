

window.addEventListener('load', function() {

  var el = $('.fixable');
  
  MakeFixable(el);

});


function MakeFixable(el, untilScreenWidth) {

  untilScreenWidth = untilScreenWidth || 0;
  
  var elPosition = elPositionInPage(el[0]);
  var elParent   = el.parent();
  var elParentPosition = elPositionInPage(elParent[0]);
  var elSibling = el.next();
  var lastYPos = 0;
	
  window.addEventListener('scroll', function() {

    if(Math.max(window.innerWidth, document.documentElement.clientWidth) > untilScreenWidth) {
      
      if(elPosition.y - 20 <= pageYOffset) {

          el.addClass('fixable');
          el[0].style.position = 'fixed';
          el[0].style.width = elParent.width() + "px";
          el[0].style.top = '0';
          el[0].style.zIndex = '10';

          elSibling[0].style.marginTop = elPosition.height + 20 + 'px';

        } else {

          el.removeClass('fixable');
          el[0].style.position = '';

          elSibling[0].style.marginTop = '';

        }

      lastYPos = pageYOffset;
    }

	});
  window.addEventListener('resize', function() {

    // elPosition = 

    if(Math.max(window.innerWidth, document.documentElement.clientWidth) < untilScreenWidth) {
     
      el.removeClass('fixable');
      el[0].style.position = '';
      el[0].style.width = "";
      el[0].style.top = '';
      el[0].style.zIndex = '';

    } else {
      
      el[0].style.width = elParent.width() + "px";

    }

  });

}

function elPositionInPage(el) {

  // Getting the offset of the el in relation to the top
  // of the page ..
  // getBoundingClientRect().top only gets the position of
  // the element in relation to the window. So we calculate
  //  the difference
  var bodyCords = document.body.getBoundingClientRect();
  var elCords = el.getBoundingClientRect();


  var bodyYOffset = bodyCords.top;
  var bodyXOffset = bodyCords.left;
  var elYOffset = elCords.top;
  var elXOffset = elCords.left;

  var elYPosition =  elYOffset - bodyYOffset;
  var elXPosition =  elXOffset - bodyXOffset;

  return {x: elXPosition, y: elYPosition, height: elCords.height, width: elCords.width};

}
