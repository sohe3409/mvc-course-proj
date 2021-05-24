Travis CI

[![Build Status](https://travis-ci.org/sohe3409/mvc-course-proj.svg?branch=master)](https://travis-ci.org/sohe3409/mvc-course-proj)


Scrutinizer CI

[![Code Coverage](https://scrutinizer-ci.com/g/sohe3409/mvc-course-proj/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/sohe3409/mvc-course-proj/?branch=master) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sohe3409/mvc-course-proj/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sohe3409/mvc-course-proj/?branch=master) [![Build Status](https://scrutinizer-ci.com/g/sohe3409/mvc-course-proj/badges/build.png?b=master)](https://scrutinizer-ci.com/g/sohe3409/mvc-course-proj/build-status/master)


# Game 21

## Description
This project was built with the framework Laravel and is the examinating project for the course MVC. I have made a game called "Game 21" which is a dice game played with one or two dices and you play against the computer. The purpose of the game is to gain coins or get a high score to make it into the High Score list. The project is connected to a sqlite database where the data is stored.


## Game rules

### Login/Register
To play Game 21 you have to be a registered user. When you load the website you will see the startpage, which displays two forms, login and register. If you are already a member you can login, otherwise you can make a new user. After you are logged in you are redirected to the game startpage which you also can reach from the navbar. 

![test img](https://user-images.githubusercontent.com/71514079/119393584-6eeacb00-bcd1-11eb-8ec3-cd53307ec3c8.png)

### Choose dices
On the game startpage you can see the amount of coins you have, if you are a new user you get 10 coins to start with. When you are ready to start playing you choose one or two dices and press the "Start!" button.

![test img](https://user-images.githubusercontent.com/71514079/119393620-79a56000-bcd1-11eb-8e1c-d85ac078b06a.png)


### Play the game
Now to the fun part! On the left you can see your amount of coins and make a bet. You can maximum bet the amount of coins you have and minimun 2 coins. If you don't want to bet you can still play, and if you win you will still gain one coin. You click the "Roll" button to start playing, you can then click the same button again until you are happy with you score, then you click on the "Stop" button. After that you can see the computers score and if you won. To the right the winning statistics are shown.

![test img](https://user-images.githubusercontent.com/71514079/119393642-8033d780-bcd1-11eb-85d0-42bf43872dff.png)

### See High Scores
You can reach the High Score page from the navbar even if you are not logged in. Here you can see two different lists. One of them displays the top 10 richest users measured in the amount of coins, the other list displays the top 10 highest saved scores and the date when it was added.

![test img](https://user-images.githubusercontent.com/71514079/119393595-74481580-bcd1-11eb-8334-b775f4b9f157.png)

## Installation
Clone the repo and run: 

```bash
Composer install
```
Then open your local server on a browser and go to "installation direcory/public" to display the website and start playing.
