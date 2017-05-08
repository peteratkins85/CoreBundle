ONI.ui.dataTable = ONI_Datatable = Class.create(ONI, {
    selector: null,
    rowOptionsTemplate: null,
    columns: [],
    initialize: function (config) {
        if (typeof config.selector === 'undefined') {
            throw new Error('DataTable "selector" must be set');
        }

        if (typeof config.rowOptionsTemplate !== 'undefined'){
            this.rowOptionsTemplate = $(config.rowOptionsTemplate);
        }

        this.selector = $(config.selector);
        this.setColumns();
        this.buildDataTable();

    },
    buildDataTable: null,
    setColumns: function () {

        var _this = this;
        _this.columns = [];

        if (_this.selector !== null){

            var tableColumns = _this.selector.find('th');

            $.each(tableColumns, function (index, th) {

                if (typeof $(th).data('row-options') !== 'undefined'){

                    _this.columns.push({
                        orderable:      false,
                        data:           null,
                        defaultContent: ""
                    });

                }else if (typeof $(th).data('column-name') !== 'undefined'){

                    _this.columns.push({
                        data: $(th).data('column-name')
                    });

                }

            });

        }

    }
});
