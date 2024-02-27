'use strict';


const product_update = document.getElementById('product_update');
const product_addreduction = document.getElementById('product_addreduction');

document.addEventListener('DOMContentLoaded', function() {   
	updateProduct(product_update);
	product_update.addEventListener('change', function(e) {updateProduct(e.target)});
	
	addreductionProduct(product_addreduction);
	product_addreduction.addEventListener('change', function(e) {addreductionProduct(e.target)});

});

function updateProduct(e) {
	const productSelected = e.selectedOptions[0];
	const productPath = productSelected.dataset.path;
	const productOldType = productSelected.dataset.type;
	const productForm = e.closest('form');
	const productPreview = productForm.querySelector('.form_preview');
	const productName = productForm.querySelector('#product_name');
	const oldType = productForm.querySelector('.oldtype');
	const productInfo = productForm.querySelector('#product_info');
	const productPrice = productForm.querySelector('#product_price');
	const productOldPath = productForm.querySelector('#product_oldpath');
	productName.value = productSelected.dataset.name;
	productInfo.value = productSelected.dataset.info;
	productPrice.value = productSelected.dataset.price;
	productOldPath.value = productSelected.dataset.path;
	
	oldType.textContent = (productOldType == 'flowers') ? 'Цветы' : 'Подарки';
	productPreview.innerHTML = `<img src="${productPath}" alt="фото">`;
}

function addreductionProduct(e) {
	const pReductionSelected = e.selectedOptions[0];
	const pReductionForm = e.closest('form');
	const pReduction = pReductionForm.querySelector('#product_reduction');
	pReduction.placeholder = pReductionSelected.dataset.reduction;
}

function imageInput(event) {
	const imagePreview = event.parentElement.querySelector('.form_preview');
    UploadFile(event, event.files[0], imagePreview);
}

function UploadFile(input, file, imagePreview) {
    if(!['image/jpeg', 'image/jpg', 'image/png'].includes(file.type)) {
        alert('Разрешены только изображения.');
        input.value = '';
        return;
    }
    if(file.size > 2 * 1024 * 1024) {
        alert('Файл должен быть менее 2 Мб.');
        input.value = '';
        return;
    }

    var reader = new FileReader();
    reader.onload = function (e) {
        imagePreview.innerHTML = `<img src="${e.target.result}" alt="фото">`;
    }
    reader.onerror = function () {
        alert('Ошибка загрузки.');
    }
    reader.readAsDataURL(file);
}