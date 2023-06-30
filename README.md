# TYPO3 t3-build Demo

This project demonstrates how to integrate [t3-build](https://www.npmjs.com/package/t3-build) with [TYPO3](https://github.com/TYPO3/typo3) both fast local development server and a CSS/Js builder.
This demo provides a browsersync server that reloades on change of code and TYPO3 backend.

t3-build provides classic HTML/CSS/Js frontend developing and component driven HTML/CSS development.

## Prerequisites

- [Docker Desktop or Colima](https://ddev.readthedocs.io/en/latest/users/install/docker-installation/)
- [DDEV](https://ddev.readthedocs.io/en/latest/)
- [Mutagen](https://ddev.readthedocs.io/en/latest/users/install/performance/#mutagen) needs to be enabled for HMR


## Local installation guide

```bash
git clone https://github.com/mxsteini/t3-build-demo.git
cd t3-build-demo
ddev start
ddev npm i
ddev npm run build
ddev composer install
ddev snapshot restore --latest
ddev npm start
```

https://t3builddemo.ddev.site/typo3

## t3-build server
[t3builddemo.ddev.site:4000](https://t3builddemo.ddev.site:4000/)

Make some changes in:

src/mst_site/html/Page/Templates/Default.html

E. g. change the body background-color in scss-section below and watch the server.

## TYPO3 backend
Login via [t3builddemo.ddev.site/typo3](https://t3builddemo.ddev.site/typo3) using these credentials:

- Username: `prepare`
- Password: `prepare`

Make some changes as you whish and watch the server

## TYPO3 frontend
[t3builddemo.ddev.site](https://t3builddemo.ddev.site/)




```bash
ddev npm start
```


