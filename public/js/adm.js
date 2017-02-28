/**
 * -----------------------------------------------------------------------------
 * @package   SyL
 * @author    k.watanabe <k.watanabe@syl.jp>
 * @copyright 2006-2009 k.watanabe
 * @license   http://www.opensource.org/licenses/lgpl-license.php
 * @version   CVS: $Id:$
 * @link      http://syl.jp/
 * -----------------------------------------------------------------------------
 */

if (!SyL) var SyL = {};
if (!SyL.Adm) SyL.Adm = {};

/**
 * Adm ユーティリティクラス
 */
SyL.Adm.Utils = {
  changeSearchArea: function(searchArea, button)
  {
    if (searchArea.style.display == "none") {
      searchArea.style.display = "block";
      button.value = "検索非表示";
    } else {
      searchArea.style.display = "none";
      button.value = "検索表示";
    }
  },

  deletesConfirm: function(form, alertFlag)
  {
    var len = form.elements.length;
    if (!len) {
      return false;
    }

    var checked = false;
    for (var i=0; i<len; i++) {
      if ((form.elements[i].type == "checkbox") && (form.elements[i].checked)) {
        checked = true;
        break;
      }
    }
    if (!checked) {
      alert("削除チェックボックスを選択してください");
      return false;
    }

    return (!alertFlag || confirm("チェックしたレコードを削除します。よろしいですか？"));
  },

  clearFormValues: function(form)
  {
    var len = form.elements.length;
    if (len) {
      for (var i=0; i<len; i++) {
        switch (form.elements[i].type) {
        case "text":
        case "textarea":
        case "password":
        case "file":
        case "hidden":
          form.elements[i].value = "";
          break;
        case "radio":
        case "checkbox":
          form.elements[i].checked = false;
          break;
        case "select-one":
        case "select-multiple":
          var elen = form.elements[i].length;
          for (var j=0; j<elen; j++) {
            form.elements[i].options[j].selected = false;
          }
          break;
        }
      }
    }
  },

  getFormValues: function(form)
  {
    var result = [];
    var len = form.elements.length;
    if (len) {
      for (var i=0; i<len; i++) {
        switch (form.elements[i].type) {
        case "text":
        case "textarea":
        case "password":
        case "file":
        case "hidden":
          result.push([form.elements[i].name, form.elements[i].value]);
          break;
        case "radio":
          if (form.elements[i].checked) {
            result.push([form.elements[i].name, form.elements[i].value]);
          }
          break;
        case "checkbox":
          if (form.elements[i].checked) {
            result.push([form.elements[i].name, form.elements[i].value]);
          }
          break;
        case "select-one":
        case "select-multiple":
          var elen = form.elements[i].length;
          for (var j=0; j<elen; j++) {
            if (form.elements[i].options[j].selected) {
              result.push([form.elements[i].name, form.elements[i].options[j].value]);
            }
          }
          break;
        }
      }
    }
    return result;
  }
};


/**
 * Adm 一覧表示クラス
 */
SyL.Adm.List = function(id, url)
{
  this.titleId     = id + "-title";
  this.searchId    = id + "-search";
  this.buttonsId   = id + "-buttons";
  this.pageLinkId1 = id + "-pagelink1";
  this.pageLinkId2 = id + "-pagelink2";
  this.tableListId = id + "-tablelist";

  this.initialize(id, url);
};

SyL.Adm.List.prototype = {
  initialize: function(id, url)
  {
    var className = (/*@cc_on!@*/false) ? "className" : "class";
    var listFormId   = id + "_list_form";
    var searchFormId = id + "_search_form";
    var loaded = false;

    var self = this;

    this.display = function (parameters)
    {
      if (typeof(parameters) != "object") {
        parameters = {};
      }

      var searchForm = document.getElementById(searchFormId);
      if (searchForm) {
        var values = SyL.Adm.Utils.getFormValues(searchForm);
        for (var i=0; i<values.length; i++) {
          parameters[values[i][0]] = encodeURIComponent(values[i][1]);
        }
      }

      parameters['action'] = 'json';

      if (document.getElementById(self.buttonsId)) {
        self.hideButtons(self.buttonsId);
      }
      if (document.getElementById(self.pageLinkId1)) {
        self.hidePageLink(self.pageLinkId1);
      }
      if (document.getElementById(self.pageLinkId2)) {
        self.hidePageLink(self.pageLinkId2);
      }

      if (document.getElementById(this.tableListId)) {
        var div = document.getElementById(this.tableListId);
        div.innerHTML = '検索中...';
      }

      SyL.Ajax.Request.sendAsyncPost(url, function(result){
        if (!loaded) {
          if (document.getElementById(self.titleId)) {
            document.getElementById(self.titleId).innerHTML = result['title'];
          }
          if (document.getElementById(self.searchId)) {
            self.createSearchArea(result, self.searchId);
          }
          if (document.getElementById(self.buttonsId)) {
            self.createButtons(result, self.buttonsId);
          }
          loaded = true;
        }

        if (document.getElementById(self.buttonsId)) {
          self.displayButtons(self.buttonsId);
        }

        if (document.getElementById(self.pageLinkId1)) {
          self.createPageLink(result, self.pageLinkId1);
          self.displayPageLink(self.pageLinkId1);
        }
        if (document.getElementById(self.tableListId)) {
          self.createList(result, self.tableListId);
        }
        if (document.getElementById(self.pageLinkId2)) {
          self.createPageLink(result, self.pageLinkId2);
          self.displayPageLink(self.pageLinkId2);
        }
      }, parameters);
    };

    this.createSearchArea = function(r, searchId)
    {
      var div = document.getElementById(searchId);
      div.innerHTML = '';

      if (!r['search_view']) {
        div.style.display = "none";
      }

      var form = document.createElement("form");
      form.id = searchFormId;
      form.style.padding = "0px";
      form.style.margin  = "0px";

      form.onsubmit = function()
      {
        self.display({'pg': '1', 'st': r['current_sort']});
        return false;
      }
      var table = document.createElement("table");
      table.setAttribute(className, "adm-detail");

      var tbody = document.createElement("tbody");
      div.appendChild(table);
      //form.appendChild(table);
      table.appendChild(tbody);

      var cols = "";
      for (var name in r['form']['elements']) {
        cols = r['form']['elements'][name]['cols'];
        switch (cols) {
        case "0":
          var tr = document.createElement("tr");
          var th = document.createElement("th");
          th.innerHTML = r['form']['elements'][name]['label'];
          tr.appendChild(th);
          var td = document.createElement("td");
          td.innerHTML = r['form']['elements'][name]['html'];
          tr.appendChild(td);
          break;
        case "1":
          var th = document.createElement("th");
          th.innerHTML = r['form']['elements'][name]['label'];
          tr.appendChild(th);
          var td = document.createElement("td");
          td.innerHTML = r['form']['elements'][name]['html'];
          tr.appendChild(td);
          tbody.appendChild(tr);
          break;
        }
      }

      if (cols == "0") {
        var th = document.createElement("th");
        th.innerHTML = "&nbsp;";
        var td = document.createElement("td");
        td.innerHTML = "&nbsp;";
        tr.appendChild(th);
        tr.appendChild(td);
        tbody.appendChild(tr);
      }

      var tr = document.createElement("tr");
      var td = document.createElement("td");
      td.colSpan = "4";
      td.style.textAlign = "right";

      var input = document.createElement("input");
      input.type = "submit";
      input.value = "　検索　"
      td.appendChild(input);

      td.appendChild(document.createTextNode(" "));

      var input = document.createElement("input");
      input.type = "reset";
      input.value = " クリア "
      td.appendChild(input);

      tr.appendChild(td);

      tbody.appendChild(tr);
    };

    this.displayButtons = function(buttonsId)
    {
      document.getElementById(buttonsId).style.display = "inline";
    };

    this.hideButtons = function(buttonsId)
    {
      document.getElementById(buttonsId).style.display = "none";
    };

    this.createButtons = function(r, buttonsId)
    {
      var div = document.getElementById(buttonsId);
      div.innerHTML = "";

      if (r['enable_new']) {
        var input = document.createElement("input");
        input.type = "button";
        input.value = "　新規　";
        input.onclick = function() {
          window.location.href = r['url_new'];
        }
        div.appendChild(input);
        div.appendChild(document.createTextNode(" "));
      }

      if (r['enable_del'] && (r['links'].length > 0)) {
        var input = document.createElement("input");
        input.type = "button";
        input.value = "　削除　";
        input.onclick = function() {
          var form = document.getElementById(listFormId);
          if (form && SyL.Adm.Utils.deletesConfirm(form, r['view_alert'])) {
            form.submit();
          }
        }
        div.appendChild(input);
        div.appendChild(document.createTextNode(" "));
      }

      if (r['links'].length > 0) {
        for (var a in r['form']['elements']) {
          var input = document.createElement("input");
          input.type = "button";
          input.value = (r['search_view'] ? " 検索非表示 " : " 検索表示 ");
          input.onclick = function() {
            SyL.Adm.Utils.changeSearchArea(document.getElementById(self.searchId), this);
          };
          div.appendChild(input);
          div.appendChild(document.createTextNode(" "));
          break;
        }
      }
    };

    this.displayPageLink = function(pageLinkId)
    {
      document.getElementById(pageLinkId).style.display = "inline";
    };

    this.hidePageLink = function(pageLinkId)
    {
      document.getElementById(pageLinkId).style.display = "none";
    };

    this.createPageLink = function(r, pageLinkId)
    {
      var div = document.getElementById(pageLinkId);
      div.innerHTML = "";

      if (r['links'].length > 0) {
        var span = document.createElement("span");
        span.innerHTML = '全 ' + r['max_page'] + 'ページ ';
        div.appendChild(document.createTextNode(" "));
        div.appendChild(span);

        if (r['current_page'] > 1) {
          var a = document.createElement("a");
          a.href    = "javascript:void(0);";
          a.onclick = function() {
            self.display({'pg': '1', 'st': r['current_sort']});
          };
          a.innerHTML = '&lt;&lt;';
          div.appendChild(a);
          div.appendChild(document.createTextNode(" "));

          var a = document.createElement("a");
          a.href    = "javascript:void(0);";
          a.onclick = function() {
            self.display({'pg': (parseInt(r['current_page'], 10) - 1), 'st': r['current_sort']});
          };
          a.innerHTML = '&lt;&nbsp;PREV';
          div.appendChild(a);
          div.appendChild(document.createTextNode(" "));
        } else {
          div.appendChild(document.createTextNode("<< < PREV "));
        }

        for (var i=0; i<r['links'].length; i++) {
          div.appendChild(document.createTextNode("|  "));
          if (r['links'][i] == r['current_page']) {
            var b = document.createElement("b");
            b.innerHTML = r['links'][i];
            div.appendChild(b);
          } else {
            var a = document.createElement("a");
            a.href    = "javascript:void(0);";
            a.onclick = (function(pg) {
              return function() { 
                self.display({'pg': pg, 'st': r['current_sort']});
              }; 
            })(r['links'][i]);
            a.innerHTML = r['links'][i];
            div.appendChild(a);
          }
          div.appendChild(document.createTextNode(" "));
        }
        div.appendChild(document.createTextNode("| "));

        if (r['max_page'] > r['current_page']) {
          var a = document.createElement("a");
          a.href    = "javascript:void(0);";
          a.onclick = function() {
            self.display({'pg': (parseInt(r['current_page'], 10) + 1), 'st': r['current_sort']});
          };
          a.innerHTML = 'NEXT&nbsp;&gt;';
          div.appendChild(a);
          div.appendChild(document.createTextNode(" "));

          var a = document.createElement("a");
          a.href    = "javascript:void(0);";
          a.onclick = function() {
            self.display({'pg': r['max_page'], 'st': r['current_sort']});
          };
          a.innerHTML = '&gt;&gt;';
          div.appendChild(a);
        } else {
          div.appendChild(document.createTextNode("NEXT > >>"));
        }
      }
    };

    this.createList = function(r, tableListId)
    {
      var div = document.getElementById(tableListId);
      div.innerHTML = '';

      var table = '';
      if (r['results'].length > 0) {
        var form  = document.createElement("form");
        form.method = "post";
        form.action = r['url_del'];
        form.id = listFormId;

        var table = document.createElement("table");
        table.setAttribute(className, "adm-list");

        var tbody = document.createElement("tbody");
        div.appendChild(form);
        form.appendChild(table);
        table.appendChild(tbody);

        var tr = document.createElement("tr");
        if (r['enable_del']) {
          var th = document.createElement("th");
          var img = document.createElement("img");
          img.setAttribute(className, "list_icon");
          img.src = r['url_dir'] + "/images/icon_del.gif";
          th.appendChild(img);
          tr.appendChild(th);
        }
        if (r['enable_upd']) {
          var th = document.createElement("th");
          var img = document.createElement("img");
          img.setAttribute(className, "list_icon");
          img.src = r['url_dir'] + "/images/icon_doc.gif";
          th.appendChild(img);
          tr.appendChild(th);
        }

        for (var i in r['headers']) {
          var th = document.createElement("th");
          var a = document.createElement("a");
          a.href    = "javascript:void(0);";
          a.onclick = (function(sort, order) {
            return function() { 
              self.display({'pg': '1', 'st': sort + '.' + order});
            }; 
          })(r['headers'][i]['sort'], r['headers'][i]['order']);
          a.innerHTML = r['headers'][i]['name'];
          th.appendChild(a);
          tr.appendChild(th);
        }
        tbody.appendChild(tr);

        for (var i=0; i<r['results'].length; i++) {
          var tr = document.createElement("tr");
          tr.setAttribute(className, ((i%2 == 0) ? 'td1' : 'td2'));
          if (r['enable_del']) {
            var td = document.createElement("td");
            td.setAttribute(className, "list_icon");
            var input = document.createElement("input");
            input.type = "checkbox";
            input.name = r['key_name'] + '[]';
            input.value = r['primary_link_parameters'][i];
            td.appendChild(input);
            tr.appendChild(td);
          }
          if (r['enable_upd']) {
            var td = document.createElement("td");
            td.setAttribute(className, "list_icon");
            var a = document.createElement("a");
            a.href = r['url_upd'] + '?' + r['key_name'] + '=' + encodeURIComponent(r['primary_link_parameters'][i]);
            var img = document.createElement("img");
            img.src = r['url_dir'] + "/images/icon_upd.gif";
            img.style.border = "0";
            a.appendChild(img);
            td.appendChild(a);
            tr.appendChild(td);
          }

          for (var j in r['headers']) {
            var td = document.createElement("td");
            if (r['enable_vew'] && (j == r['primary_name'])) {
              var a = document.createElement("a");
              a.href = r['url_vew'] + '?' + r['key_name'] + '=' + encodeURIComponent(r['primary_link_parameters'][i]);
              a.innerHTML = r['results'][i][j];
              td.appendChild(a);
            } else {
              if (r['results'][i][j] == null) {
                td.innerHTML = '&nbsp;';
              } else {
                td.innerHTML = r['results'][i][j];
              }
            }
            tr.appendChild(td);
          }
          tbody.appendChild(tr);
        }
      } else {
        var diva = document.createElement("div");
        diva.setAttribute(className, "alert");
        diva.innerHTML = "データがありませんでした";
        div.appendChild(diva);
      }
    };
  }
}
