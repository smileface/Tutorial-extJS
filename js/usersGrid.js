Ext.Loader.setConfig({
    enabled: true
});

Ext.Loader.setPath('Ext', '/js/ext-all.js');

Ext.require([
    'Ext.grid.*',
    'Ext.data.*'
]);

Ext.onReady(function(){

    Ext.define('Account', {
        extend: 'Ext.data.Model',
        fields: ['name','education','city']
    });

    var store = Ext.create('Ext.data.Store', {
        model: 'Account',
        proxy: {
            type: 'ajax',
            url: '/site/GetElements',
            reader: {
                type: 'json',
                root: 'data',
                successProperty: false
            }
        },
        autoLoad: true
    });

    var CheckboxGroupUsers = new Ext.form.CheckboxGroup({
        id: 'checkboxGroupUsers',
        allowBlank: true,
        labelAlign:'top',
        fieldLabel: 'Имена',
        columns: 1,
        renderTo: 'filterUsers'
    });

    var jsonStoreUsers = new Ext.data.JsonStore({
        autoLoad: true,
        method: 'POST',
        fields: ['id', 'name'],
        proxy:  {
            type: 'ajax',
            url: '/site/GetUsers',
            reader: {
                type: 'json'
            }
        },
        listeners: {
            load: function (t, records, options) {
                Array.map(records, function(record) {
                    CheckboxGroupUsers.add({
                        boxLabel: record.get('name'),
                        name: 'Elements[users][]',
                        inputValue: record.get('id')
                    })
                });
            }
        }
    });

    var CheckboxGroupEducations = new Ext.form.CheckboxGroup({
        id: 'checkboxGroupEducations',
        allowBlank: true,
        labelAlign:'top',
        fieldLabel: 'Образование',
        columns: 1,
        renderTo: 'filterEducations'
    });

    var jsonStoreEducations = new Ext.data.JsonStore({
        autoLoad: true,
        method: 'POST',
        fields: ['id', 'name'],
        proxy:  {
            type: 'ajax',
            url: '/site/GetEducations',
            reader: {
                type: 'json'
            }
        },
        listeners: {
            load: function (t, records, options) {
                Array.map(records, function(record) {
                    CheckboxGroupEducations.add({
                        boxLabel: record.get('name'),
                        name: 'Elements[educations][]',
                        inputValue: record.get('id')
                    })
                });
            }
        }
    });

    var CheckboxGroupCities = new Ext.form.CheckboxGroup({
        id: 'checkboxGroupCities',
        allowBlank: true,
        labelAlign:'top',
        fieldLabel: 'Города',
        columns: 1,
        renderTo: 'filterCities'
    });

    var jsonStoreCities = new Ext.data.JsonStore({
        autoLoad: true,
        method: 'POST',
        fields: ['id', 'name'],
        proxy:  {
            type: 'ajax',
            url: '/site/GetCities',
            reader: {
                type: 'json'
            }
        },
        listeners: {
            load: function (t, records, options) {
                Array.map(records, function(record) {
                    CheckboxGroupCities.add({
                        boxLabel: record.get('name'),
                        name: 'Elements[cities][]',
                        inputValue: record.get('id')
                    })
                });
            }
        }
    });

    var grid = Ext.create('Ext.grid.Panel', {
        store: store,
        columns: [
            {
                xtype: 'rownumberer'
            },
            {
                text     : 'Имя пользователя',
                dataIndex: 'name'
            },
            {
                text     : 'Образование',
                dataIndex: 'education'
            },
            {
                text     : 'Город',
                dataIndex: 'city'
            }
        ],
        height: 350,
        width: '100%',
        title: 'Таблица учеников',
        renderTo: 'usersGrid'

    });

    Ext.create('Ext.button.Button', {
        text: 'Обновить список',
        renderTo: 'updateGrid',
        handler: function() {
            var users = new Array();
            var educations = new Array();
            var cities = new Array();

            users.push(getSelectedCheckboxes(CheckboxGroupUsers));
            educations.push(getSelectedCheckboxes(CheckboxGroupEducations));
            cities.push(getSelectedCheckboxes(CheckboxGroupCities));

            store.proxy.extraParams = {'filter': true, 'users': users, 'educations': educations, 'cities': cities};
            store.load();
        }

    });

    function getSelectedCheckboxes(checkboxGroup) {
        var result = new Array();
        var selectedCategory = checkboxGroup.getChecked();

        for(var i = 0; i < selectedCategory.length; i++){
            result.push(selectedCategory[i].inputValue);
        }

        return result;
    }
});