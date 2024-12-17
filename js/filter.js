document.addEventListener('DOMContentLoaded', function () {
  const filterForm = document.querySelector('.filter-menu form');

  if (filterForm) {
    filterForm.addEventListener('submit', function (e) {
      const categoryInputs = filterForm.querySelectorAll(
        'input[name="sub_cat"]:checked'
      );
      if (categoryInputs.length > 0) {
        let combinedCategories = [];
        categoryInputs.forEach((input) => {
          combinedCategories.push(input.value);
        });

        categoryInputs.forEach((input) => input.remove());

        const combinedInput = document.createElement('input');
        combinedInput.type = 'hidden';
        combinedInput.name = 'sub_cat';
        combinedInput.value = combinedCategories.join(',');
        filterForm.appendChild(combinedInput);
      }
    });
  }
});
