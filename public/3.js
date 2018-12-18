webpackJsonp([3],{

/***/ 239:
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
    data: function data() {
        return {
            validate: {
                details: [{ required: true }]
            },
            form: {
                details: '',
                billboard_id: '',
                billboardpartytype: 'clients',
                date_hired_from: '',
                date_hired_to: ''
            },
            billboards: [],
            types: [],
            loading: false,
            disabled: false
        };
    },
    beforeRouteEnter: function beforeRouteEnter(to, from, next) {
        if (to.params.id) {
            axios.get('/api/billboards/' + to.params.id).then(function (response) {
                next(function (vm) {
                    return vm.setData(response.data);
                });
            });
        } else {
            next();
        }
    },
    beforeRouteUpdate: function beforeRouteUpdate(to, from, next) {
        var vm = this;
        if (to.params.id) {
            axios.get('/api/billboards/' + to.params.id).then(function (response) {
                vm.setData(response.data);
                next();
            });
        } else {
            next();
        }
    },

    computed: {
        type: function type() {
            return this.form.billboardpartytype == 'clients' ? 'Client' : 'Agency';
        }
    },
    methods: {
        setData: function setData(response) {
            this.form = response;
        },
        onCancel: function onCancel() {
            this.$router.push({ name: 'view-billboardhired' });
        },
        search_billboard: function search_billboard(query) {
            var vm = this;
            if (query !== '') {
                vm.onSearchBillboard(query, vm);
            } else {
                vm.loading = false;
                vm.billboardhireds = [];
            }
        },

        onSearchBillboard: _.debounce(function (query, vm) {
            vm.loading = true;
            axios.get('/api/billboards/search?search=' + query).then(function (q) {
                vm.loading = false;
                vm.billboards = q.data.map(function (item) {
                    return { value: item.id, label: item.details };
                });
            }).catch(function () {
                vm.loading = false;
            });
        }, 350),
        search_type: function search_type(query) {
            var vm = this;
            if (query !== '') {

                vm.onSearchType(query, vm);
            } else {
                vm.loading = false;
                vm.billboardhireds = [];
            }
        },

        onSearchType: _.debounce(function (query, vm) {
            vm.loading = true;
            axios.get('/api/' + vm.form.billboardpartytype + '/search?search=' + query).then(function (q) {
                vm.loading = false;
                vm.types = q.data.map(function (item) {
                    return { value: item.id, label: item.details };
                });
            }).catch(function () {
                vm.loading = false;
            });
        }, 350),
        onSubmit: function onSubmit() {
            var vm = this;
            this.$refs.form.validate(function (valid) {
                if (valid) {
                    vm.disabled = true;
                    var id = vm.$route.params.id;
                    axios[id ? 'put' : 'post']('/api/billboardhireds' + (id ? '/' + id : ''), vm.form).then(function () {
                        vm.disabled = false;
                        vm.$message({
                            type: 'success',
                            message: 'Billboard has been created'
                        });
                    }).catch(function (error) {
                        vm.disabled = false;
                        if (error.response.statusText) {
                            vm.$message({
                                type: 'error',
                                message: error.response.statusText
                            });
                        }
                    });
                }
            });
        }
    }
});

/***/ }),

/***/ 240:
/***/ (function(module, exports, __webpack_require__) {

var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    [
      _c(
        "el-row",
        [
          _c(
            "el-col",
            { attrs: { span: 24 } },
            [
              _c(
                "el-card",
                { attrs: { shadow: "never" } },
                [
                  _c("div", { attrs: { slot: "header" }, slot: "header" }, [
                    _c("span", [_vm._v("Add Billboard Hired")])
                  ]),
                  _vm._v(" "),
                  _c(
                    "el-form",
                    {
                      ref: "form",
                      attrs: { model: _vm.form, "label-width": "120px" },
                      nativeOn: {
                        submit: function($event) {
                          $event.preventDefault()
                          return _vm.onSubmit($event)
                        }
                      }
                    },
                    [
                      _c(
                        "el-form-item",
                        {
                          attrs: {
                            prop: "billboard_id",
                            rules: _vm.$root.validate.required,
                            label: "Billboard"
                          }
                        },
                        [
                          _c(
                            "el-select",
                            {
                              staticStyle: { width: "100%" },
                              attrs: {
                                size: "small",
                                disabled: _vm.disabled,
                                filterable: "",
                                remote: "",
                                required: "",
                                placeholder: "Enter Billboard Keyboard",
                                "remote-method": _vm.search_billboard,
                                loading: _vm.loading
                              },
                              model: {
                                value: _vm.form.billboard_id,
                                callback: function($$v) {
                                  _vm.$set(_vm.form, "billboard_id", $$v)
                                },
                                expression: "form.billboard_id"
                              }
                            },
                            _vm._l(_vm.billboards, function(item, index) {
                              return _c("el-option", {
                                key: index,
                                attrs: { label: item.label, value: item.value }
                              })
                            }),
                            1
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "el-form-item",
                        {
                          attrs: {
                            prop: "billboardpartytype",
                            rules: _vm.$root.validate.required,
                            label: "Hiring Parties"
                          }
                        },
                        [
                          _c(
                            "el-select",
                            {
                              staticStyle: { width: "100%" },
                              attrs: {
                                size: "small",
                                placeholder: "Enter Hiring Parties Keyboard"
                              },
                              model: {
                                value: _vm.form.billboardpartytype,
                                callback: function($$v) {
                                  _vm.$set(_vm.form, "billboardpartytype", $$v)
                                },
                                expression: "form.billboardpartytype"
                              }
                            },
                            [
                              _c("el-option", {
                                attrs: { label: "Client", value: "clients" }
                              }),
                              _vm._v(" "),
                              _c("el-option", {
                                attrs: { label: "Agency", value: "agencies" }
                              })
                            ],
                            1
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "el-form-item",
                        {
                          attrs: {
                            prop: "type",
                            rules: _vm.$root.validate.required,
                            label: _vm.type
                          }
                        },
                        [
                          _c(
                            "el-select",
                            {
                              staticStyle: { width: "100%" },
                              attrs: {
                                size: "small",
                                disabled: _vm.disabled,
                                filterable: "",
                                remote: "",
                                required: "",
                                placeholder: "Enter " + _vm.type + " Keyboard",
                                "remote-method": _vm.search_type,
                                loading: _vm.loading
                              },
                              model: {
                                value: _vm.form.type,
                                callback: function($$v) {
                                  _vm.$set(_vm.form, "type", $$v)
                                },
                                expression: "form.type"
                              }
                            },
                            _vm._l(_vm.types, function(item, index) {
                              return _c("el-option", {
                                key: index,
                                attrs: { label: item.label, value: item.value }
                              })
                            }),
                            1
                          )
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "el-form-item",
                        {
                          attrs: {
                            prop: "date_hired_from",
                            label: "Date Hired From"
                          }
                        },
                        [
                          _c("el-date-picker", {
                            attrs: { type: "datetime" },
                            model: {
                              value: _vm.form.date_hired_from,
                              callback: function($$v) {
                                _vm.$set(_vm.form, "date_hired_from", $$v)
                              },
                              expression: "form.date_hired_from"
                            }
                          })
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "el-form-item",
                        {
                          attrs: {
                            prop: "date_hired_to",
                            label: "Date Hired To"
                          }
                        },
                        [
                          _c("el-date-picker", {
                            attrs: { type: "datetime" },
                            model: {
                              value: _vm.form.date_hired_to,
                              callback: function($$v) {
                                _vm.$set(_vm.form, "date_hired_to", $$v)
                              },
                              expression: "form.date_hired_to"
                            }
                          })
                        ],
                        1
                      ),
                      _vm._v(" "),
                      _c(
                        "el-form-item",
                        [
                          _c(
                            "el-button",
                            {
                              attrs: {
                                disabled: _vm.disabled,
                                type: "primary"
                              },
                              on: {
                                click: function($event) {
                                  _vm.onSubmit("form")
                                }
                              }
                            },
                            [
                              _vm._v(
                                _vm._s(
                                  _vm.$route.params.id ? "Edit" : "Create"
                                ) + "\n                        "
                              )
                            ]
                          ),
                          _vm._v(" "),
                          _c("el-button", { on: { click: _vm.onCancel } }, [
                            _vm._v("Cancel")
                          ])
                        ],
                        1
                      )
                    ],
                    1
                  )
                ],
                1
              )
            ],
            1
          )
        ],
        1
      )
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true
module.exports = { render: render, staticRenderFns: staticRenderFns }
if (false) {
  module.hot.accept()
  if (module.hot.data) {
    require("vue-hot-reload-api")      .rerender("data-v-397b767f", module.exports)
  }
}

/***/ }),

/***/ 81:
/***/ (function(module, exports, __webpack_require__) {

var disposed = false
var normalizeComponent = __webpack_require__(47)
/* script */
var __vue_script__ = __webpack_require__(239)
/* template */
var __vue_template__ = __webpack_require__(240)
/* template functional */
var __vue_template_functional__ = false
/* styles */
var __vue_styles__ = null
/* scopeId */
var __vue_scopeId__ = null
/* moduleIdentifier (server only) */
var __vue_module_identifier__ = null
var Component = normalizeComponent(
  __vue_script__,
  __vue_template__,
  __vue_template_functional__,
  __vue_styles__,
  __vue_scopeId__,
  __vue_module_identifier__
)
Component.options.__file = "resources/js/components/billboardhired/create.vue"

/* hot reload */
if (false) {(function () {
  var hotAPI = require("vue-hot-reload-api")
  hotAPI.install(require("vue"), false)
  if (!hotAPI.compatible) return
  module.hot.accept()
  if (!module.hot.data) {
    hotAPI.createRecord("data-v-397b767f", Component.options)
  } else {
    hotAPI.reload("data-v-397b767f", Component.options)
  }
  module.hot.dispose(function (data) {
    disposed = true
  })
})()}

module.exports = Component.exports


/***/ })

});