@extends('layouts.app')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">  
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
 
<style>
form > div > div > *{
    margin: 1rem;
}
form > * {
    margin: 1rem;
}


</style>
@endsection

@section('content') 


<div class="mx-auto col-8" id="app" style="margin-top: 5rem;">
<div id="eroro" class="alert alert-danger" role="alert" style="display : none ;"></div>  

        <form id="forma" v-on:submit="postLeave" method="POST">
           <select id="motif" v-model="selected"  class="form-control" > 
                <option disabled value="">Choisissez</option>
                <option value="Congé de naissance">Congé de naissance</option>
                <option value="Congé mariage">Congé mariage</option>
                <option value="Opération chirurgicale">Opération chirurgicale</option>
                <option value="Circoncision" selected>Circoncision</option>
                <option value="Congé payes" selected>Congé payes</option>
                <option value="Décès">Décès</option>
            </select>
            
            <input type="radio" id="m"  onclick="Checkradiobuttona()" >
            <label for="html">Autre motif</label><br>
            <input type="text" class="form-control"   v-model="selected" id="Motift" placeholder="Autre motif" style="display:none;" >
            
            
            <textarea class="form-control"  v-model="justification"  placeholder="justification" ></textarea>

            <div>
                <input type="radio" id="hour" name="typechoix" value="hours" onclick="Checkradiobuttonh()" >
                <label for="html">demi journée</label><br>
                <div id="h" style="display:none;">
                    <input type="text" class="form-control" v-model="debut"  id="timedebut" placeholder="Date" >
                    <select v-model="temp" id="motif" class="form-control"  >
                        <option disabled value="">Choisissez</option>
                        <option value="0">Matin</option>
                        <option value="1">Après midi</option>
                    </select>
                </div>
                
                <input type="radio" id="day" name="typechoix" value="days"  onclick="Checkradiobuttond()">
                <label for="html">plusieur jours</label><br>
                <div id="d" style="display:none;">
                    <input type="text" class="form-control" v-model="debut" id="timedebut" placeholder="Date de Debut" >
                    <input type="text" class="form-control"  v-model="fin" id="timedebutf" placeholder="Date de Fin" >
                </div>
            </div>
                
            <button type="submit"  class="btn btn-info" style="margin-top: 1rem;" > demander </button>
        </form>
</div>

@endsection



@section('javascript') 

<script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/vue@2.6.0"></script>
<script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
const id = "{{ json_encode(Auth::user()->id) }}"

function Checkradiobuttonh(){
    if (document.getElementById('hour').checked) {
        document.getElementById('h').style.display  = "block"
        document.getElementById('d').style.display  = "none"

    } 
}

function Checkradiobuttond(){
    if (document.getElementById('day').checked) {
        document.getElementById('d').style.display  = "block"
        document.getElementById('h').style.display  = "none"

    } 

}

function Checkradiobuttona(){
    if (document.getElementById('m').checked) {
        document.getElementById('Motift').style.display  = "block"
    } 

}


var app = new Vue({
    delimiters: ['{%', '%}'],
    el:'#app',
    data() {
        return {
            selected:'',
            debut:'',
            fin:'',
            temp:'',
            justification:''
        }
    },

    methods : {        
        postLeave(event) {
            event.preventDefault()
            if(this.selected != '' && this.justification != '' ){            
                if (document.getElementById('hour').checked) {
                                if(this.temp == 0){
                                    this.fin=this.debut.toString().substr(0,11)+"13:00:00"
                                    this.debut=this.debut.toString().substr(0,11)+"08:00:00"
                                }else{
                                    this.fin=this.debut.toString().substr(0,11)+"18:00:00"
                                    this.debut=this.debut.toString().substr(0,11)+"13:00:00"
                                }
                        }
                    if(this.fin != '' && this.debut != ''){
                    console.log(this.justification, this.selected, this.debut , this.fin , this.temp )
                    axios.post('/add_leave',{'justification':this.justification,'date_debut': this.debut , 'date_fin':this.fin , 'motif':this.selected})
                    .then((res)=>{window.location.href = '/my_leaves/'+id})
                    }else{
                        document.getElementById("eroro").style.display = "block"
                        document.getElementById("eroro").innerHTML = "vérifiez vos informations"
                    }
                    }else{
                        document.getElementById("eroro").style.display = "block"
                        document.getElementById("eroro").innerHTML = "vérifiez vos informations"
                    }
        }
    }
})

config = {
    time_24hr: true,
    enableTime: true,
    altInput : true ,
    dateFormat: "Y-m-d 00:00:01",
    altFormat:  "Y-m-d 00:00:01",
    minDate: "today",
    "locale": {
    "firstDayOfWeek": 1 // start week on Monday
    }
}
fp=flatpickr("#timedebut",config)


config = {
    time_24hr: true,
    enableTime: true,
    altInput : true ,
    dateFormat: "Y-m-d 23:59:59",
    altFormat:  "Y-m-d 23:59:59",
    minDate: "today",
    "locale": {
    "firstDayOfWeek": 1 // start week on Monday
    }
}
fp=flatpickr("#timedebutf",config)

// fp.hourElement.style.display = 'none'
// fp.minuteElement.style.display = 'none'



</script>

@endsection

