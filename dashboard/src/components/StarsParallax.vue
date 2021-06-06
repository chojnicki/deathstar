<!-- Ported and optimized from http://codepen.io/saransh/pen/BKJun -->
<!-- TODO remake this as SVG -->
<template>
  <div class="stars-parallax absolute z-10 h-screen top-0">
    <div />
    <div />
    <div />
  </div>
</template>

<style lang="postcss">
.stars-parallax {
  width: 2000px;
  left: calc(50vw - 1000px);

  div:nth-child(1) {
    width: 3px;
    height: 3px;
    background: transparent;
    box-shadow: generateStars(25); /* defined in postcss.config.js */
    animation: animStar 25s linear infinite;

    &:after {
      content: "";
      position: absolute;
      top: 2000px;
      width: 3px;
      height: 3px;
      background: transparent;
      box-shadow: generateStars(25);
    }
  }

  div:nth-child(2) {
    width: 2px;
    height: 2px;
    background: transparent;
    box-shadow: generateStars(75);
    animation: animStar 50s linear infinite;

    &:after {
      content: "";
      position: absolute;
      top: 2000px;
      width: 2px;
      height: 2px;
      background: transparent;
      box-shadow: generateStars(75);
    }
  }

  div:nth-child(3) {
    width: 1px;
    height: 1px;
    background: transparent;
    box-shadow: generateStars(200);
    animation: animStar 100s linear infinite;

    &:after {
      content: "";
      position: absolute;
      top: 2000px;
      width: 1px;
      height: 1px;
      background: transparent;
      box-shadow: generateStars(200);
    }
  }
}

@keyframes animStar {
  from {
    transform: translate3d(0, 0, 0);
  }
  to {
    transform: translate3d(0, -2000px, 0);
  }
}
</style>
