(function() {
    "use strict"; // Start of use strict
    window.onload = function () {

        document.querySelectorAll('form').forEach((form) => {
            form.addEventListener('submit', (e) => {
                if((e.submitter.classList.contains("btn-delete") || e.submitter.classList.contains("btn-danger")) && !confirm("Confirm deletion?")) {
                    e.preventDefault();
                }
            })
        })
        document.getElementById('selectAll').addEventListener('click', function(){
            let self = this;
            let checked = self.checked;
            console.log(checked);
            document.querySelector('#commentsForm')
                .querySelectorAll('input[type=checkbox]')
                .forEach((checkbox) =>{
                    checkbox.checked = checked;
            })
        })

    }
})(); // End of use strict
