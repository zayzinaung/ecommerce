$(function(){
    var Event = Backbone.Model.extend();

    var Events = Backbone.Collection.extend({
         initialize : function(models,options){
            this.model = options.model ,
            this.url = options.url        
        }
    }); 
 
    var EventsView = Backbone.View.extend({
        initialize: function(){
            _.bindAll(this); 

            this.collection.bind('reset', this.addAll);
            this.collection.bind('add', this.addOne);
            this.collection.bind('change', this.change);            
            this.collection.bind('destroy', this.destroy);            
            this.eventView = new EventView();            
        },
        render: function() {
            this.$el.fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title'
                },
                selectable: true,
                selectHelper: true,
                editable: false,
                ignoreTimezone: false,                
                select: this.select,
                eventClick: this.eventClick,
                 eventDrop: this.eventDropOrResize,        
                 eventResize: this.eventDropOrResize
            });
        },
        addAll: function() {
            this.$el.fullCalendar('addEventSource', this.collection.toJSON());
        },
        addOne: function(event) {
            this.$el.fullCalendar('renderEvent', event.toJSON());
        },        
        select: function(startDate, endDate) {
            this.eventView.collection = this.collection;
            this.eventView.model = new Event({start: startDate, end: endDate});
            this.eventView.render();            
        },
        eventClick: function(fcEvent) {
            this.eventView.model = this.collection.get(fcEvent.id);
            this.eventView.render();
        },
        change: function(event) {           
          if(!event.isNew()) {
            var fcEvent = this.$el.fullCalendar('clientEvents', event.get('id'))[0];
            fcEvent.title = event.get('title');
            fcEvent.color = event.get('color');
            this.$el.fullCalendar('updateEvent', fcEvent);
          }            

        },
        eventDropOrResize: function(fcEvent) {           
            this.collection.get(fcEvent.id).save({start: fcEvent.start, end: fcEvent.end});            
        },
        destroy: function(event) {
            this.$el.fullCalendar('removeEvents', event.id);         
        }        
    });

    var EventView = Backbone.View.extend({
        el: $('#eventDialog'),
        initialize: function() {
            _.bindAll(this);           
        },
        render: function() {
            var buttons = {'Ok': this.save};
            if (!this.model.isNew()) {
                _.extend(buttons, {'Delete': this.destroy});
            }
            _.extend(buttons, {'Cancel': this.close});            

            this.$el.dialog({
                modal: true,
                title: (this.model.isNew() ? 'New' : 'Edit') + ' Attendance',
                buttons: buttons,
                open: this.open
            });

            return this;
        },        
        open: function() {
            this.$('#title').val(this.model.get('title'));
            this.$('#color').val(this.model.get('color'));            
        },        
        save: function() {
            this.model.set({'title': this.$('#title').val(), 'color': this.$('#color').val()});
            
            if(this.model.isNew()) {
                this.collection.create(this.model, { success: window.location.reload(true) } );
            }else{
                this.model.save({}, {success: this.close });
            }
        },
        close: function() {
            this.$el.dialog('close');
        },
        destroy: function() {
            this.model.destroy({success: this.close});
        }        
    });
    
    var events = new Events([],{ model : Event , url : $("#url").html() });
    new EventsView({el: $("#calendar"), collection: events}).render();
    events.fetch();
});