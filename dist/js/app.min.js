/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./src/js/app.js":
/*!***********************!*\
  !*** ./src/js/app.js ***!
  \***********************/
/***/ (() => {

document.addEventListener('DOMContentLoaded', function () {
  // --------------------------
  // NavBar JavaScript Code
  // --------------------------
  var dropDownIcon = document.getElementById('drop-down-icon');
  var dropDownItems = document.getElementById('mobile-drop-down');
  var closeIcons = document.getElementById('close-menu');
  if (dropDownIcon && dropDownItems && closeIcons) {
    dropDownIcon.addEventListener('click', function () {
      if (dropDownItems.style.display === 'none') {
        dropDownItems.style.display = 'flex';
      } else {
        dropDownItems.style.display = 'none';
      }
    });
    closeIcons.addEventListener('click', function () {
      if (dropDownItems.style.display === 'flex') {
        dropDownItems.style.display = 'none';
      }
    });
  }

  // --------------------------
  // Hero JavaScript Code
  // --------------------------
  function scrollToBottom() {
    window.scrollTo({
      top: document.body.scrollHeight,
      behavior: "smooth"
    });
  }

  // --------------------------
  // Blogs JavaScript Code
  // --------------------------
  var carouselBlogs = document.querySelector('.carousel-blogs');
  if (carouselBlogs) {
    var updateCarouselBlogs = function updateCarouselBlogs() {
      carouselBlogs.style.transform = "translateX(-".concat(currentIndexBlogs * cardWidthBlogs, "px)");
    };
    var nextBtnBlogs = document.getElementById('nextBtn-blogs');
    var prevBtnBlogs = document.getElementById('prevBtn-blogs');
    var totalOriginalCardsBlogs = 12;
    var visibleCardsBlogs = 8;
    var cardWidthBlogs = 340;
    var currentIndexBlogs = visibleCardsBlogs;

    // Clone first and last few items for infinite scroll
    for (var i = 0; i < visibleCardsBlogs; i++) {
      var clone = carouselBlogs.children[i].cloneNode(true);
      carouselBlogs.appendChild(clone);
    }
    for (var _i = totalOriginalCardsBlogs - visibleCardsBlogs; _i < totalOriginalCardsBlogs; _i++) {
      var _clone = carouselBlogs.children[_i].cloneNode(true);
      carouselBlogs.insertBefore(_clone, carouselBlogs.firstChild);
    }
    var totalCardsBlogs = carouselBlogs.children.length;
    carouselBlogs.style.transform = "translateX(-".concat(currentIndexBlogs * cardWidthBlogs, "px)");
    var isTransitioningBlogs = false;
    if (nextBtnBlogs && prevBtnBlogs) {
      nextBtnBlogs.addEventListener('click', function () {
        if (isTransitioningBlogs) return;
        isTransitioningBlogs = true;
        currentIndexBlogs++;
        updateCarouselBlogs();
      });
      prevBtnBlogs.addEventListener('click', function () {
        if (isTransitioningBlogs) return;
        isTransitioningBlogs = true;
        currentIndexBlogs--;
        updateCarouselBlogs();
      });
    }
    carouselBlogs.addEventListener('transitionend', function () {
      isTransitioningBlogs = false;
      if (currentIndexBlogs >= totalOriginalCardsBlogs + visibleCardsBlogs) {
        currentIndexBlogs = visibleCardsBlogs;
        carouselBlogs.style.transition = 'none';
        carouselBlogs.style.transform = "translateX(-".concat(currentIndexBlogs * cardWidthBlogs, "px)");
        carouselBlogs.offsetHeight; // Trigger reflow
        carouselBlogs.style.transition = 'transform 0.5s ease-in-out';
      }
      if (currentIndexBlogs < visibleCardsBlogs) {
        currentIndexBlogs = totalOriginalCardsBlogs + visibleCardsBlogs - 1;
        carouselBlogs.style.transition = 'none';
        carouselBlogs.style.transform = "translateX(-".concat(currentIndexBlogs * cardWidthBlogs, "px)");
        carouselBlogs.offsetHeight;
        carouselBlogs.style.transition = 'transform 0.5s ease-in-out';
      }
    });
  }

  // --------------------------
  // Developers JavaScript Code
  // --------------------------
  var carouselDevelopment = document.querySelector('.carousel-development');
  if (carouselDevelopment) {
    var updateCarouselDevelopment = function updateCarouselDevelopment() {
      carouselDevelopment.style.transform = "translateX(-".concat(currentIndexDevelopment * cardWidthDevelopment, "px)");
    };
    var nextBtnDevelopment = document.getElementById('nextBtn-development');
    var prevBtnDevelopment = document.getElementById('prevBtn-development');
    var totalOriginalCardsDevelopment = 21;
    var visibleCardsDevelopment = 8;
    var cardWidthDevelopment = 165;
    var currentIndexDevelopment = visibleCardsDevelopment;
    for (var _i2 = 0; _i2 < visibleCardsDevelopment; _i2++) {
      var _clone2 = carouselDevelopment.children[_i2].cloneNode(true);
      carouselDevelopment.appendChild(_clone2);
    }
    for (var _i3 = totalOriginalCardsDevelopment - visibleCardsDevelopment; _i3 < totalOriginalCardsDevelopment; _i3++) {
      var _clone3 = carouselDevelopment.children[_i3].cloneNode(true);
      carouselDevelopment.insertBefore(_clone3, carouselDevelopment.firstChild);
    }
    var totalCardsDevelopment = carouselDevelopment.children.length;
    carouselDevelopment.style.transform = "translateX(-".concat(currentIndexDevelopment * cardWidthDevelopment, "px)");
    var isTransitioningDevelopment = false;
    if (nextBtnDevelopment && prevBtnDevelopment) {
      nextBtnDevelopment.addEventListener('click', function () {
        if (isTransitioningDevelopment) return;
        isTransitioningDevelopment = true;
        currentIndexDevelopment++;
        updateCarouselDevelopment();
      });
      prevBtnDevelopment.addEventListener('click', function () {
        if (isTransitioningDevelopment) return;
        isTransitioningDevelopment = true;
        currentIndexDevelopment--;
        updateCarouselDevelopment();
      });
    }
    carouselDevelopment.addEventListener('transitionend', function () {
      isTransitioningDevelopment = false;
      if (currentIndexDevelopment >= totalOriginalCardsDevelopment + visibleCardsDevelopment) {
        currentIndexDevelopment = visibleCardsDevelopment;
        carouselDevelopment.style.transition = 'none';
        carouselDevelopment.style.transform = "translateX(-".concat(currentIndexDevelopment * cardWidthDevelopment, "px)");
        carouselDevelopment.offsetHeight;
        carouselDevelopment.style.transition = 'transform 0.5s ease-in-out';
      }
      if (currentIndexDevelopment < visibleCardsDevelopment) {
        currentIndexDevelopment = totalOriginalCardsDevelopment + visibleCardsDevelopment - 1;
        carouselDevelopment.style.transition = 'none';
        carouselDevelopment.style.transform = "translateX(-".concat(currentIndexDevelopment * cardWidthDevelopment, "px)");
        carouselDevelopment.offsetHeight;
        carouselDevelopment.style.transition = 'transform 0.5s ease-in-out';
      }
    });
  }

  // --------------------------
  // Feedback JavaScript Code
  // --------------------------
  var blogs = document.querySelectorAll('.blog');
  if (blogs.length > 0) {
    var showBlog = function showBlog(index) {
      blogs.forEach(function (blog) {
        return blog.classList.remove('active');
      });
      blogs[index].classList.add('active');
    };
    var currentBlogIndex = 0;
    blogs[currentBlogIndex].classList.add('active');
    var nextBtnFeedback = document.getElementById('nextBtn-feedback');
    var prevBtnFeedback = document.getElementById('prevBtn-feedback');
    if (nextBtnFeedback && prevBtnFeedback) {
      nextBtnFeedback.addEventListener('click', function () {
        currentBlogIndex = (currentBlogIndex + 1) % blogs.length;
        showBlog(currentBlogIndex);
      });
      prevBtnFeedback.addEventListener('click', function () {
        currentBlogIndex = (currentBlogIndex - 1 + blogs.length) % blogs.length;
        showBlog(currentBlogIndex);
      });
    }
  }

  // --------------------------
  // Modern Projects JavaScript Code
  // --------------------------
  var carouselModernProjects = document.querySelector('.carousel-modern-projects');
  if (carouselModernProjects) {
    var updateCarouselModernProjects = function updateCarouselModernProjects() {
      carouselModernProjects.style.transform = "translateX(-".concat(currentIndexModernProjects * cardWidthModernProjects, "px)");
    };
    var nextBtnModernProjects = document.getElementById('nextBtn-modern-projects');
    var prevBtnModernProjects = document.getElementById('prevBtn-modern-projects');
    var totalOriginalCardsModernProjects = 12;
    var visibleCardsModernProjects = 8;
    var cardWidthModernProjects = 340;
    var currentIndexModernProjects = visibleCardsModernProjects;
    for (var _i4 = 0; _i4 < visibleCardsModernProjects; _i4++) {
      var _clone4 = carouselModernProjects.children[_i4].cloneNode(true);
      carouselModernProjects.appendChild(_clone4);
    }
    for (var _i5 = totalOriginalCardsModernProjects - visibleCardsModernProjects; _i5 < totalOriginalCardsModernProjects; _i5++) {
      var _clone5 = carouselModernProjects.children[_i5].cloneNode(true);
      carouselModernProjects.insertBefore(_clone5, carouselModernProjects.firstChild);
    }
    var totalCardsModernProjects = carouselModernProjects.children.length;
    carouselModernProjects.style.transform = "translateX(-".concat(currentIndexModernProjects * cardWidthModernProjects, "px)");
    var isTransitioningModernProjects = false;
    if (nextBtnModernProjects && prevBtnModernProjects) {
      nextBtnModernProjects.addEventListener('click', function () {
        if (isTransitioningModernProjects) return;
        isTransitioningModernProjects = true;
        currentIndexModernProjects++;
        updateCarouselModernProjects();
      });
      prevBtnModernProjects.addEventListener('click', function () {
        if (isTransitioningModernProjects) return;
        isTransitioningModernProjects = true;
        currentIndexModernProjects--;
        updateCarouselModernProjects();
      });
    }
    carouselModernProjects.addEventListener('transitionend', function () {
      isTransitioningModernProjects = false;
      if (currentIndexModernProjects >= totalOriginalCardsModernProjects + visibleCardsModernProjects) {
        currentIndexModernProjects = visibleCardsModernProjects;
        carouselModernProjects.style.transition = 'none';
        carouselModernProjects.style.transform = "translateX(-".concat(currentIndexModernProjects * cardWidthModernProjects, "px)");
        carouselModernProjects.offsetHeight;
        carouselModernProjects.style.transition = 'transform 0.5s ease-in-out';
      }
      if (currentIndexModernProjects < visibleCardsModernProjects) {
        currentIndexModernProjects = totalOriginalCardsModernProjects + visibleCardsModernProjects - 1;
        carouselModernProjects.style.transition = 'none';
        carouselModernProjects.style.transform = "translateX(-".concat(currentIndexModernProjects * cardWidthModernProjects, "px)");
        carouselModernProjects.offsetHeight;
        carouselModernProjects.style.transition = 'transform 0.5s ease-in-out';
      }
    });
  }

  // --------------------------
  // Top Cities JavaScript Code
  // --------------------------
  var carouselTopCities = document.querySelector('.carousel-top-cities');
  if (carouselTopCities) {
    var updateCarouselTopCities = function updateCarouselTopCities() {
      carouselTopCities.style.transform = "translateX(-".concat(currentIndexTopCities * cardWidthTopCities, "px)");
    };
    var nextBtnTopCities = document.getElementById('nextBtn-top-cities');
    var prevBtnTopCities = document.getElementById('prevBtn-top-cities');
    var totalOriginalCardsTopCities = 12;
    var visibleCardsTopCities = 8;
    var cardWidthTopCities = 340;
    var currentIndexTopCities = visibleCardsTopCities;
    for (var _i6 = 0; _i6 < visibleCardsTopCities; _i6++) {
      var _clone6 = carouselTopCities.children[_i6].cloneNode(true);
      carouselTopCities.appendChild(_clone6);
    }
    for (var _i7 = totalOriginalCardsTopCities - visibleCardsTopCities; _i7 < totalOriginalCardsTopCities; _i7++) {
      var _clone7 = carouselTopCities.children[_i7].cloneNode(true);
      carouselTopCities.insertBefore(_clone7, carouselTopCities.firstChild);
    }
    var totalCardsTopCities = carouselTopCities.children.length;
    carouselTopCities.style.transform = "translateX(-".concat(currentIndexTopCities * cardWidthTopCities, "px)");
    var isTransitioningTopCities = false;
    if (nextBtnTopCities && prevBtnTopCities) {
      nextBtnTopCities.addEventListener('click', function () {
        if (isTransitioningTopCities) return;
        isTransitioningTopCities = true;
        currentIndexTopCities++;
        updateCarouselTopCities();
      });
      prevBtnTopCities.addEventListener('click', function () {
        if (isTransitioningTopCities) return;
        isTransitioningTopCities = true;
        currentIndexTopCities--;
        updateCarouselTopCities();
      });
    }
    carouselTopCities.addEventListener('transitionend', function () {
      isTransitioningTopCities = false;
      if (currentIndexTopCities >= totalOriginalCardsTopCities + visibleCardsTopCities) {
        currentIndexTopCities = visibleCardsTopCities;
        carouselTopCities.style.transition = 'none';
        carouselTopCities.style.transform = "translateX(-".concat(currentIndexTopCities * cardWidthTopCities, "px)");
        carouselTopCities.offsetHeight;
        carouselTopCities.style.transition = 'transform 0.5s ease-in-out';
      }
      if (currentIndexTopCities < visibleCardsTopCities) {
        currentIndexTopCities = totalOriginalCardsTopCities + visibleCardsTopCities - 1;
        carouselTopCities.style.transition = 'none';
        carouselTopCities.style.transform = "translateX(-".concat(currentIndexTopCities * cardWidthTopCities, "px)");
        carouselTopCities.offsetHeight;
        carouselTopCities.style.transition = 'transform 0.5s ease-in-out';
      }
    });
  }

  // --------------------------
  // Footer JavaScript Code
  // --------------------------
  var arrowForLinks = document.getElementById('arrow-for-links');
  var arrowForContactUs = document.getElementById('arrow-for-contact-us');
  var linkMenus = document.getElementById('links-menu');
  var contactUsMenus = document.getElementById('contact-us-menu');
  if (arrowForLinks && linkMenus) {
    arrowForLinks.addEventListener('click', function () {
      arrowForLinks.classList.toggle('active');
      linkMenus.classList.toggle('active');
      if (arrowForLinks.classList.contains('active')) {
        arrowForLinks.style.transform = 'rotate(180deg)';
      } else {
        arrowForLinks.style.transform = 'rotate(0deg)';
      }
    });
  }
  if (arrowForContactUs && contactUsMenus) {
    arrowForContactUs.addEventListener('click', function () {
      arrowForContactUs.classList.toggle('active');
      contactUsMenus.classList.toggle('active');
      if (arrowForContactUs.classList.contains('active')) {
        arrowForContactUs.style.transform = 'rotate(180deg)';
      } else {
        arrowForContactUs.style.transform = 'rotate(0deg)';
      }
    });
  }

  // --------------------------
  // WhatsApp and Phone Icons JavaScript Code
  // --------------------------
  var stickyElements = document.querySelector('.contact-side-bar');
  if (stickyElements) {
    window.addEventListener('scroll', function () {
      var scrollHeight = 600;
      if (window.scrollY >= scrollHeight) {
        stickyElements.style.display = 'flex';
      } else {
        stickyElements.style.display = 'none';
      }
    });
  }
  // --------------------------
  // Zoom Meeting Form JavaScript Code
  // --------------------------
  function generateDaysForNextMonth() {
    var dayListContainer = document.getElementById('day-list');
    if (!dayListContainer) return; // Exit if the element doesn't exist

    dayListContainer.innerHTML = '';
    var today = new Date();
    var endDate = new Date(today);
    endDate.setMonth(today.getMonth() + 1);
    var currentDate = new Date(today);
    while (currentDate <= endDate) {
      var dayItem = document.createElement('div');
      dayItem.className = 'day-item';
      dayItem.textContent = "".concat(currentDate.getDate(), " - ").concat(currentDate.toLocaleDateString('default', {
        month: 'long'
      }), " - ").concat(currentDate.getFullYear());
      dayListContainer.appendChild(dayItem);
      currentDate.setDate(currentDate.getDate() + 1);
    }
  }
  generateDaysForNextMonth();
  document.querySelectorAll('path').forEach(function (item) {
    item.style.cursor = 'pointer';
  });
});

/***/ }),

/***/ "./src/import.scss":
/*!*************************!*\
  !*** ./src/import.scss ***!
  \*************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/dist/js/app": 0,
/******/ 			"dist/css/main": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunkveel"] = self["webpackChunkveel"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["dist/css/main"], () => (__webpack_require__("./src/js/app.js")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["dist/css/main"], () => (__webpack_require__("./src/import.scss")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;