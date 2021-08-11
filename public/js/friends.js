/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/friends.js ***!
  \*********************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var notifications = document.querySelectorAll("#notifications > div");

var Friends = /*#__PURE__*/function () {
  function Friends(notifications) {
    _classCallCheck(this, Friends);

    this.notificationsContainers = notifications;
    this.initializeNotifications();
  }

  _createClass(Friends, [{
    key: "initializeNotifications",
    value: function initializeNotifications() {
      var _this = this;

      this.notifications = {};

      var _iterator = _createForOfIteratorHelper(this.notificationsContainers),
          _step;

      try {
        var _loop = function _loop() {
          var _container$querySelec;

          var container = _step.value;
          _this.notifications[container.id] = container;
          (_container$querySelec = container.querySelector(".friendship-accept")) === null || _container$querySelec === void 0 ? void 0 : _container$querySelec.addEventListener("click", function () {
            _this.accept(container.id);
          });
          container.querySelector(".friendship-reject").addEventListener("click", function () {
            _this.reject(container.id);
          });
        };

        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          _loop();
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }
    }
  }, {
    key: "accept",
    value: function accept(id) {
      elmoreFetch("/api/requests/confirm", {
        id: id
      });
      this.notifications[id].remove();
    }
  }, {
    key: "reject",
    value: function reject(id) {
      elmoreFetch("/api/notifications/delete", {
        id: id
      });
      this.notifications[id].remove();
    }
  }]);

  return Friends;
}();

var friends = new Friends(notifications);
/******/ })()
;