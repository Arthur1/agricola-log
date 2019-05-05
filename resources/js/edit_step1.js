let form = document.forms[0];

const playersNumberTrigger = () => {
	let playersNumber = form.players_number.value;
	let playerOrderOptions = document.querySelectorAll('#form_player_order option');
	playerOrderOptions.forEach((option) => {
		option.disabled = option.value > playersNumber;
	});
	let playerOrderSelect = document.querySelectorAll('#form_player_order');
	M.FormSelect.init(playerOrderSelect, {});
};

document.addEventListener('DOMContentLoaded', () => {
	let selects = document.querySelectorAll('select');
	M.FormSelect.init(selects, {});
	playersNumberTrigger();
});

form.players_number.addEventListener('change', playersNumberTrigger);
