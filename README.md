# Code for https://alanmckay.blog

This repository exists to track the progress of my personal portfolio. The portfolio includes a range of computer science related topics from web development to the discussion of theory. The motive of having a website housing project a portfolio has evolved to an extent such that the website can be considered a digital garden with the inclusion of personal writings. This is elaborated further in the about-page of the website.

Code used here is developed form scratch, barring the normalizing css stylesheet which was taken from a [repository](github.com/necolas/normalize.css) hosted by [necolas](https://github.com/necolas). The code is templated using PHP and a non-traditional layout is leveraged whilst still maintaining accessibility for a variety of browsing environments.

This readme file will act as a progress checklist for items I would like to develop for the website.

## To-do list:

- [ ] Implement a project page discussing research done pertaining to chat-gpt and stack-overflow comparison.
- [ ] Implement a project page discussing my experience as a university adjunct teaching data structures.
- [ ] Javascript refactor to DRY out the scripts currently in use:
    - [x] Mobile scrolling logic used in index pages.
        - `primeClassTransitions()`
        - `applyClassTransitionEffects()`
    - [x] Logic for expandable lists.
        - `toggleCollapsible()`
    - [x] Functionalty that changes the position of an image based on scroll position.
        - `reframeImage()`
    - [ ] Functionality that repositions a figure with a set of javascript controls.
        - `setDynamicFigureStyle()`
- [ ] Implement webmentions.
