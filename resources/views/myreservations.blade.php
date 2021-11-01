@extends('layouts.app')
@section('content')

<div class="row">


    <div  class="col" id="app">

        <div class="modal-body row">
            <div class="col-md-8">
            <div class="page-header text-center">
                <h2>My Gym Reservations</h2>
            </div>
            <div v-if="loading">Chargement...</div>



                    <div class="list-group" >
                        <div  v-for="item in items"  class="list-group-item" >
                            <a >{% item.reservation_time %}</a>
                             <button v-if="compareNow(item.reservation_time)" class="btn btn-danger  float-right ml-2 active" @click="deletereservation(item.reservation_time, $event)"> Delete </button>
                        </div>
                    </div>
        </div>



</div>
</div>

@endsection


@section('javascript')
<script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> 
<script>

const id = "{{ json_encode(Auth::user()->id) }}"
new Vue({
delimiters: ['{%', '%}'],
el: '#app',
data () {
    return {
    items: null,
    loading: true,
    errored: false,

    }
},
methods :{
    deletereservation : function(item , event) {
    event.preventDefault() // it prevent from page reload
    axios.delete('/reservations/'+item)
        .then(response => {
        location.reload();
        }).catch(error => {
                    console.log(error)
                }); 
    },
    compareNow: function(reservation_time){
        return new Date(reservation_time) >  new Date()
    }
},
mounted () {
    axios
    .get('/reservations/'+id)
    .then(response => (this.items = response.data)).catch(error => {
                    console.log(error)
                    this.errored = true
                })
                .finally(() => this.loading = false)
}
})
</script>
@endsection






