@extends('layouts.app')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">  
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>

        .content-wrapper{
            height: 100%;
            width: 100%;
        }

            .video-container {
            height: 100%;
            width: 100%;
            overflow: hidden;
            position: relative;
            }

            .video-container video {

            position: fixed;
            right: 0;
            bottom: 0;
            top: 50%;
            left: 50%;
            transform: translateX(-50%) translateY(-50%);
            }

            /* Just styling the content of the div, the *magic* in the previous rules */
            .video-container #app {
            z-index: 1;
            position: relative;
            text-align: center;
            color: #dc0000;
            padding: 10px;
            }


    </style>
@endsection
            
@section('content') 


<div class="video-container">
<video autoplay loop muted>
        <source src="" type="video/mp4">
</video>
  <div  id="app"  >
    <div class="mx-auto col-5" style="margin-top: 5rem;">
        <form v-on:submit="getData">
            <div id="succ" class="alert alert-success" role="alert" style="display : none ;"></div>  
            <div id="eroro" class="alert alert-danger" role="alert" style="display : none ;"></div>  
            <input type="text" v-model="date" class="form-control"  id="timesport" placeholder="Choisir l'heure de sport" required>
            <button type="submit"  class="btn btn-info" style="margin-top: 1rem;" :disabled="!found"  > Ajouter </button>
        </form>
    </div>
</div>
</div>







@endsection



@section('javascript') 

<!-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script> -->
<script type="text/javascript" language="javascript" src="https://unpkg.com/vue/dist/vue.js"></script>
<script type="text/javascript" language="javascript" src="https://unpkg.com/vue-router/dist/vue-router.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>
<script>

const id = "{{ json_encode(Auth::user()->id) }}"
const sex = "{{ json_encode(Auth::user()->gender) }}"

// code of same week
function weeksBetween(d1, d2) {
    return Math.round(Math.abs(d2 - d1) / (7 * 24 * 60 * 60 * 1000))
}

function isDateWeek(date1,firstDayOfWeek ,lastDayOfWeek) {
// if date is equal or within the first and last dates of the week
return date1 >= firstDayOfWeek && date1 <= lastDayOfWeek;
}

var app = new Vue({
    
    delimiters: ['{%', '%}'],

    el: '#app',
    
    data() {
        return {
            date: '',
            reservations :[],


        }
    },



    created () {

        this.interval = setInterval(() => this.getRes(), 1000);
    },

    methods : {

        getRes() {
            axios
            .get('/reservations',{})
            .then(response => (this.reservations =  Array.from(JSON.parse(JSON.stringify(response.data)))))
        },

        getData(event) {
            event.preventDefault()
            reservation = this.date.toString().substr(0,14)+"00:00"
            console.log(reservation)
            axios.post('/reservations',{'user_id':id ,'reservation_time' : reservation }).then(response => {
                if(response.status === 200) {
                    this.date = ""
                    document.getElementById("succ").style.display = "block"
                    document.getElementById("succ").innerHTML = "successful operation"
                    window.location.href = '/myreservations'
            }
            })

        }
    },

    computed :{
        found :  function() {
            var v = true
            var allreservations = Array.from(JSON.parse(JSON.stringify(this.reservations)))
            var id_hours =[]
            var full_hours=[]
            var date_temp = this.date.toString().substr(0,11)


            count_unique_reservations = allreservations.reduce( (acc, o) => (acc[o.reservation_time] = (acc[o.reservation_time] || 0)+1, acc), {} )
            
            console.log("all reservation")
            console.log(allreservations)
            
            console.log("reservations distinct each one with its occu number")
            console.log( count_unique_reservations)



            console.log("full hours 5 hours ")
            console.log( full_hours)

            id_reservations =  allreservations.filter( item => item["user_id"] == id,[]);
            console.log( "user reservations" )
            console.log( id_reservations )

            id_reservations.sort((a,b)=>new Date(a["reservation_time"]).getTime()- new Date(b["reservation_time"]).getTime());

            id_reservations_days = id_reservations.map( a => (a["reservation_time"].toString().substr(0,11)),[]);
            l = id_reservations.length
            last_three_dates = id_reservations.slice(l-3)
            console.log('last_three_dates')
            console.log(last_three_dates)




            v1=v2=v3 = true
            message_error = ''



            // //  condition
            if (message_error == ''){
            if ( id_reservations_days.includes(date_temp)) {
                message_error = " vous avez le droit d'une seance par jour . " 
                v3=false
                
            }}

            // condition
            var i = 0
            try {

                var tObj = new Date(this.date.toString().substr(0,11));
                var tDate = tObj.getDate();
                var tDay = tObj.getDay();
                // get first date of week
                var firstDayOfWeek = new Date(tObj.setDate(Math.abs(tDate - tDay)));
                // get last date of week
                var lastDayOfWeek = new Date(firstDayOfWeek);
                lastDayOfWeek.setDate(lastDayOfWeek.getDate() + 6);
                console.log(lastDayOfWeek  ,firstDayOfWeek  )
                lastDayOfWeek.setDate(lastDayOfWeek.getDate() + 6);

                if (last_three_dates.length == 3){
                    for (let item in last_three_dates) {
                        console.log(item)
                        test = isDateWeek(new Date(last_three_dates[item]["reservation_time"]),firstDayOfWeek ,  lastDayOfWeek )
                        console.log("testtt",test)
                        console.log(last_three_dates[item]["reservation_time"],firstDayOfWeek ,  lastDayOfWeek)
                        if (test){
                            console.log('yes')
                            ++i
                            console.log(i)
                            if(i == 3) {
                                message_error = "vous avez le droit de 3 seances par semaine , veuillez attendre la semaine prochaine " 
                                v2=false
                            }
                        }                   
                }
                }
        
                }
                catch(error){
                    console.error(error);
                }



                 // condition

                if( message_error == ''){ 
                    for (let item in count_unique_reservations) {
                            if (count_unique_reservations[item] >= 5){
                                full_hours.push(item.toString())
                            }
                    }   
                    if(full_hours.includes(this.date)) {
                        message_error = "desole salle est plein , veuillez choisir une autre heure ."    
                        v1=false           
                    }

                }


              
           
            
            // result
            v = v1 && v2 && v3
            console.log("vvvvvvvv",v)
            if (v) { document.getElementById("eroro").style.display = "none" } else {
                document.getElementById("eroro").style.display = "block"
                document.getElementById("eroro").innerHTML = message_error
            }
            message_error = ''


            return v

        }
    }





})

var nTime =""
var MTime = ""
// calender
if (app.$data.sex == "M") {
    mTime= "07:00"
    MTime= "12:00"
}else{
    mTime= "13:00"
    MTime= "18:00"
}

config = {
    time_24hr: true,
    enableTime: true,
    altInput : true ,
    dateFormat: "Y-m-d H:00:00",
    altFormat:  "Y-m-d H:00:00",
    minTime: mTime,
    maxTime: MTime,
    minDate: "today",
    maxDate: new Date().fp_incr(6), // 6 days from now
    "locale": {
    "firstDayOfWeek": 1 // start week on Monday
    },
}
fp=flatpickr("#timesport",config)
fp.minuteElement.style.display = 'none'


</script>

@endsection

