'use strict';
const calc = {
	fields: (number) => {
		switch (number) {
			case 0:
			case 1:
				return -1;
			case 2:
				return 1;
			case 3:
				return 2;
			case 4:
				return 3;
			default:
				return 4;
		}
	},
	pastures: (number) => {
		switch (number) {
			case 0:
				return -1;
			case 1:
				return 1;
			case 2:
				return 2;
			case 3:
				return 3;
			default:
				return 4;
		}
	},
	grain: (number) => {
		switch (number) {
			case 0:
				return -1;
			case 1:
			case 2:
			case 3:
				return 1;
			case 4:
			case 5:
				return 2;
			case 6:
			case 7:
				return 3;
			default:
				return 4;
		}
	},
	vegetable: (number) => {
		switch (number) {
			case 0:
				return -1;
			case 1:
				return 1;
			case 2:
				return 2;
			case 3:
				return 3;
			default:
				return 4;
		}
	},
	sheep: (number) => {
		switch (number) {
			case 0:
				return -1;
			case 1:
			case 2:
			case 3:
				return 1;
			case 4:
			case 5:
				return 2;
			case 6:
			case 7:
				return 3;
			default:
				return 4;
		}
	},
	boar: (number) => {
		switch (number) {
			case 0:
				return -1
			case 1:
			case 2:
				return 1;
			case 3:
			case 4:
				return 2;
			case 5:
			case 6:
				return 3;
			default:
				return 4;
		}
	},
	cattle: (number) => {
		switch (number) {
			case 0:
				return -1
			case 1:
				return 1;
			case 2:
			case 3:
				return 2;
			case 4:
			case 5:
				return 3;
			default:
				return 4;
		}
	},
	horses: (number) => {
		if (number === 0) {
			return -1;
		}
		return number;
	},
	unused_spaces: (number) => {
		return number * -1;		
	},
	stable: (number) => {
		switch (number) {
			case 1:
				return 1;
			case 2:
				return 2;
			case 3:
				return 3;
			case 4:
				return 4;
			default:
				return 0;
		}
	},
	clay_rooms: (number) => {
		return number;
	},
	stone_rooms: (number) => {
		return number * 2;
	},
	family: (number) => {
		return number * 3;
	},
	family_sick: (number) => {
		return number * -2;
	},
	begging: (number) => {
		return number * -3;
	},
	card: (number) => {
		return number;
	},
	bonus: (number) => {
		return number;
	}
};

const inf = 9999;
const minf = -9999;

const numberMinList = {
	fields: 0,
	pastures: 0,
	grain: 0,
	vegetable: 0,
	sheep: 0,
	boar: 0,
	cattle: 0,
	horses: 0,
	unused_spaces: 0,
	stable: 0,
	clay_rooms: 0,
	stone_rooms: 0,
	family: 0,
	family_sick: 0,
	begging: 0,
	card: minf,
	bonus: minf,
};

const numberMaxList = {
	fields: 13,
	pastures: 5,
	grain: inf,
	vegetable: inf,
	sheep: inf,
	boar: inf,
	cattle: inf,
	horses: inf,
	unused_spaces: 13,
	stable: 4,
	clay_rooms: 15,
	stone_rooms: 15,
	family: 5,
	family_sick: 5,
	begging: inf,
	card: inf,
	bonus: inf,
};

const form = document.forms[0];
const counters = document.querySelectorAll('.counter');

counters.forEach((counter) => {
	let category = counter.dataset.category;
	let btnInc = counter.querySelector('.btn_inc');
	let btnDec = counter.querySelector('.btn_dec');
	let counterNumber = counter.querySelector('.counter_number');
	let counterPoints = counter.querySelector('.counter_points');
	const numberMax = numberMaxList[category];
	const numberMin = numberMinList[category];

	const updatePoints = (number) => {
		let points = calc[category](number);
		counterPoints.innerHTML = points + '点';
		form[category + '_points'].value = points;
	};

	const updateBtnState = (number) => {
		btnInc.disabled = (number + 1 > numberMax);
		btnDec.disabled = (number - 1 < numberMin);
	};

	const updateTotalPoints = () => {
		let pointsForms = document.querySelectorAll('.form_points');
		let totalPoints = 0;
		pointsForms.forEach((form) => {
			totalPoints += parseInt(form.value);
		});
		document.getElementById('form_total_points').value = totalPoints;
		M.updateTextFields();
	};

	const update = (number) => {
		updatePoints(number);
		updateBtnState(number);
		updateTotalPoints();
	};

	document.addEventListener('DOMContentLoaded', () => {
		let number = parseInt(counterNumber.innerHTML);
		update(number);
	});

	btnInc.addEventListener('click', () => {
		let number = parseInt(counterNumber.innerHTML);
		counterNumber.innerHTML = ++number;
		update(number);
	});

	btnDec.addEventListener('click', () => {
		let number = parseInt(counterNumber.innerHTML);
		counterNumber.innerHTML = --number;
		update(number);
	});
});
