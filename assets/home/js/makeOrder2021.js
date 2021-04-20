'use strict';
function changeSiblingValue(element, action) {
    let input = $(element).siblings('input')[0];
    changeInputQuantity(input, action);
    return;
}

function changeInputQuantity(input, action) {
    let max = input.max;
    let min = input.min;
    let newValue = parseInt(input.value);

    (action) ? newValue++  : newValue--;

    if (newValue >= min && newValue <= max) {
        setInputAttribte(input, 'value', newValue);
    }

    return;
}

function clearModal(modalId) {
    let modal = document.getElementById(modalId);
    let inputs = modal.getElementsByTagName('input');
    let inputsLength = inputs.length;
    let i;
    for (i = 0; i < inputsLength; i++) {
        let input = inputs[i];
        if (input.type === 'checkbox') {
            input.checked = false;
            dipsalyButtons(input);
            input.removeAttribute('checked');
        } else if (input.type === 'text')  {
            setInputAttribte(input, 'value', '');
        }
    }
    return;
}

function setInputAttribte(input, attribute, newValue) {
    input[attribute] = newValue;
    input.setAttribute(attribute, newValue);
}

function dipsalyButtons(element) {
    let elementToDisplay = element.parentElement.parentElement.nextElementSibling;
    let displayStyle = element.checked ? 'display:initial' : 'display:none';
    let input = elementToDisplay.getElementsByTagName('input')[0];

    setInputAttribte(elementToDisplay, 'style', displayStyle);
    setInputAttribte(input, 'value', '1');
    setInputAttribte(input, 'disabled', !element.checked);
    setInputAttribte(element, 'checked', element.checked);
}

function mainProductQuantity(element, action, productName, productPrice) {
    changeSiblingValue(element, action);
    let template = getItemTemplate(productName, productPrice);
    appendInCheckoutModal(template);
    // to do 
    // => show element in checkout modal if not in modal
    // => change value for all elements with same data-id
    // => remove element if value is 0
    // => reset value to 0 on product list if element is removed
}

function addInCheckoutList(modalId, dataProductId, productName, productPrice) {
    let modal = document.getElementById(modalId);
    let modalBodyHtml = modal.getElementsByClassName('modal-body')[0].innerHTML;
    let productQuantityInput = document.querySelector('[data-id="' + dataProductId + '"]');
    showAllInCheckoutModal(modalBodyHtml, productName, productPrice);
    changeInputQuantity(productQuantityInput, true);
    clearModal(modalId);
    $('#' + modalId).modal('hide');
}

function showAllInCheckoutModal(html, productName, productPrice) {
    let template = getAllItemTemplate(html, productName, productPrice);
    appendInCheckoutModal(template);
}

function appendInCheckoutModal(html) {
    $('#checkout-modal-list').append(html);
}

function getAllItemTemplate(html, productName, productPrice) {

    return  `<div>
                <div class='menu-list__item' style="border-bottom: 0px #fff;">
                    <div class='menu-list__name'>
                        <b>${productName}</b>
                    </div>
                    <div class='menu-list__right-col'>
                        <div class='menu-list__price'>
                            <b class='menu-list__price'>${productPrice}&euro; </b>
                        </div>
                    </div>
                </div>
                ${html}
            </div>`;
}

function getItemTemplate(productName, productPrice) {

    return  `<div class="menu-list__item">
                <div class="menu-list__name">
                    <b class="menu-list__title">${productName}</b>
                </div>
                <div class="menu-list__right-col">
                    <div class="menu-list__price">
                        <b class="menu-list__price--regular">${productPrice}&euro; </b>
                    </div>
                    <div class="quantity-section">
                        <button class="quantity-button quantity-button--minus">-</button>
                        <input
                            type="number"
                            value="1"
                            placeholder="0"
                            class="quantity-input"
                            data-price="${productPrice}"
                        />
                        <button type="button" class="quantity-button quantity-button--plus">+</button>
                    </div>
                </div>
            </div>`;
}

//<button type='button'><i class="fa fa-pencil-square-o mr-2"></i>EDIT</button>

/*function runSplider() {
    let slidersPerPage = getSlidersPerPage();
    var splideCategories = new Splide(
        '#splideCategories',
            {
                perPage    : slidersPerPage,
                perMove    : 1,
                height     : '12vw',
                focus      : 'center',
                trimSpace  : false,
				type       : 'loop',
				pagination : false,
				gap         : 15,
				speed      : 400
            }
        ).mount(window.splide.Extensions);
}*/

/*function getSlidersPerPage() {
    let bodyWidth = document.body.clientWidth;
    return bodyWidth < 768 ? '1' : '6';
}*/

$(document).ready(function() {
    $('[data-toggle="popover"]').popover({
        animation : false,
        placement : "right",
        container: 'body'
    });

    /*runSplider();*/

});

// Modal Inputs change values 
var modalButtonPlus = $('.single-product__button--plus');
var modalButtonMinus = $('.single-product__button--minus');

modalButtonPlus.click(function(){
	
})

// add active class to modals input 

var modalButton = $('.single-product__button');

modalButton.click(function(){
	var modalInputvalue = $(this).siblings('input[type=number]').val();
	if( modalInputvalue == 0){
		$(this).parents('.form-group').removeClass('active');
	}else{
		$(this).parents('.form-group').addClass('active');
	}
})


// new slider 

// Create and mount the thumbnails slider.
var secondarySlider = new Splide( '#secondary-category-slider', {
	rewind      : false,
	isNavigation: true,
	focus       : 'center',
	pagination  : false,
	cover       : false,
	/*fixedWidth  : '15vw',
	height      : '15vw',*/
    perPage    : 4,
	perMove    : 4,
	breakpoints : {
		'540': {
			perPage    : 3,
	        perMove    : 3,
		},
		'768': {
			perPage    : 4,
	        perMove    : 4,
		}
	}
} ).mount();

// Create the main slider.
var primarySlider = new Splide( '#primary-category-slider', {
	type       : 'fade',
	heightRatio: 0.5,
	pagination : false,
	arrows     : false,
	cover      : true,
} );

// Set the thumbnails slider as a sync target and then call mount.
primarySlider.sync( secondarySlider ).mount();

// open checkout 

$('.checkout').on('scroll touchmove mousewheel', function(e){
  e.preventDefault();
  e.stopPropagation();
  return false;
})

var openCheckout = $('#open-checkout');
var closeCheckout = $('.checkout-hide');

openCheckout.click(function(){
	$('.checkout').addClass('active');
})

closeCheckout.click(function(){
	$('.checkout').removeClass('active');
})
