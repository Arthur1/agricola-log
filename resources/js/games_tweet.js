'use strict';

document.addEventListener('DOMContentLoaded', () => {
	let elems = document.querySelectorAll('.materialboxed');
	M.Materialbox.init(elems, {});
	M.CharacterCounter.init(document.querySelectorAll('#form_tweet_message'));
});
