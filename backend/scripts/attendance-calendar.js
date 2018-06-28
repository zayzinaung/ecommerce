$(function(){
  
  var EventObject;

  var Events = Backbone.Collection.extend({
     initialize : function(model,options){
          _.bindAll(this);          
          this.url = options.url
     }
  });

  var EventView = Backbone.View.extend({      
      initialize : function(){        
        _.bindAll(this);
        this.collection.on('reset',this.addAll,this);
        events.fetch();
      },
      
      render : function(){          
         this.$el.fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title'
                },
                selectable: true,
                selectHelper: true,
                editable: false,
                ignoreTimezone: false,                
                eventClick: this.eventClick,
                eventDrop: this.eventDropOrResize,        
                eventResize: this.eventDropOrResize
            });
      },

      addAll : function(){
         this.$el.fullCalendar('addEventSource', this.collection.toJSON());
      },

      eventClick : function(event){
        var base_url = $('#base_url').val();

        EventObject =  this.collection.get(event.id);

        this.eventTitle = EventObject.get('title');

        this.eventId = EventObject.get('id');

        this.is_holiday = parseInt(EventObject.get('is_holiday'));

       if(this.is_holiday == 1){
              $('#eventDialog').dialog({
                modal: true,
                title: this.eventTitle,
                width : 300
             });
        }
       else{
            window.location.href = base_url+"/admin/attendance/set/"+this.eventId;
       }

      
      }     

   });
   
   var events =  new Events([],{ url : $('#eventUrl').html() });
   new EventView({ el : '#calendar' , collection : events }).render();
   

   
    
});