# TYPO3 t3-build Demo

This project demonstrates how to integrate [t3-build](https://www.npmjs.com/package/t3-build) with [TYPO3](https://github.com/TYPO3/typo3) both fast local development server and a CSS/Js builder.
This demo provides a browsersync server that reloades on change of code and TYPO3 backend.

t3-build also provides classic HTML/CSS/Js frontend developing.

A special feature is the encapsulation of HTML components with HTML and CSS. This follows the speparation of concern paradigm.



## Local installation guide
To see the full power of t3-build, you can choose between the standalone mode or the TYPO3 mode.

### Standalone Demo
#### Prerequisites
- node 16

In standalone mode t3-build provides a small template engine powered by posthtml. Just start width:

```bash
git clone https://github.com/mxsteini/t3-build-demo.git
cd t3-build-demo
npm i
npm run standalone
```
Browsersync: \
https://alone.t3builddemo.localhost:8082

If you see the demo page, you go to src/mst_itb and peek and poke in any file you want.

### TYPO3 Demo
The TYPO3 Demo show the full power of t3-build.

#### Prerequisites

- [Docker Desktop or Colima](https://ddev.readthedocs.io/en/latest/users/install/docker-installation/)
- [DDEV](https://ddev.readthedocs.io/en/latest/)
- [Mutagen](https://ddev.readthedocs.io/en/latest/users/install/performance/#mutagen) needs to be enabled for HMR

#### start demo

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
Since browsersync is running in ddev, the url has the wrong protocol.

Browsersync: \
https://t3builddemo.ddev.site:4000/

TYPO3 frontend: \
https://t3builddemo.ddev.site

TYPO3 backend:
- Username: `prepare`
- Password: `prepare`

https://t3builddemo.ddev.site/typo3

If you see the demo page, you go to src/mst_itb and peek and poke in any file you want.
You can also login into the backend and change things. Each save event should trigger the browsersync and you could see your changes instantly.

