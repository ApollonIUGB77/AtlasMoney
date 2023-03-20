// Animation for title
const title = document.querySelector('.left-side h1');
const titleWords = title.innerText.split(' ');
title.innerHTML = '';
titleWords.forEach(word => {
  const span = document.createElement('span');
  span.innerHTML = word + ' ';
  title.appendChild(span);
});

const titleSpans = document.querySelectorAll('.left-side h1 span');
titleSpans.forEach((span, index) => {
  span.style.animationDelay = `${index * 0.1}s`;
});

// Continuous display of user's name
const nameElement = document.querySelector('.left-side p');
const userName = '<?php echo strtoupper($_SESSION["name]; ?>';


const animateName = () => {
  nameElement.innerText = nameElement.innerText.slice(1) + nameElement.innerText.slice(0, 1);
}

nameElement.innerText = userName + ', YOU ARE WELCOME! ';

setInterval(() => {
  animateName();
}, 300);
