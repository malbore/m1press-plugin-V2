let test = document.querySelectorAll("input.img_editor");
if (test.length > 0) {
    test.forEach(lol => {
        lol.addEventListener('click', () => {
            console.log('lol');
        })
    })
}

console.log('test');
jQuery('input[type="checkbox"]').on("change", function ($) {
	$('input[name="' + this.name + '"]')
		.not(this)
		.prop("checked", false);
});