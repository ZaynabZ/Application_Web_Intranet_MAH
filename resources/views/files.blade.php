@extends('layouts.app')
@section('content')

<div class="container">
<div class="row">

    @if(!( Auth::user()->isUser() ||Auth::user()->isSupervisor()  ))
    <div class="col">


                <div class="panel-heading"><h2>Upload fichiers</h2></div>
                <div class="panel-body">
            
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                    </div>
                    <!-- <img src="uploads/{{ Session::get('file') }}"> -->
                    @endif
            
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> 
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            
                    <form action="{{ route('file.upload.post') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
            
                            <div class="col-md-6">
                                <input type="file" name="file" class="form-control">
                            </div>
            
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
            
                        </div>
                    </form>
            
                </div>
                </div>

    </div>
    @endif

    <div  class="col" id="app">

        <div class="row" style="margin:2rem;">
            <div class="search-wrapper panel-heading col-sm-12">
                        <input class="form-control" type="text" v-model="searchQuery" placeholder="Search" />
                    </div>                        
        </div>


        <section v-if="errored">
                <p>Nous sommes désolés, nous ne sommes pas en mesure de récupérer ces informations pour le moment. Veuillez réessayer ultérieurement.</p>
        </section>


        <div class="modal-body row">
            <div class="col-md-8">
            <div class="page-header text-center">
                <h2>MyOpla Files</h2>
            </div>
            <div v-if="loading">Chargement...</div>



                    <div class="list-group" >
                        <div v-if ="item.includes('.pdf')" v-for="item in resultQuery" :key="item"  class="list-group-item" >
                            <a v-bind:href="'/showp/'+item" >{% item %}</a>
                            <button class="btn btn-danger  float-right ml-2 active" @click="deleteFile(item, $event)"> Delete </button>
                        </div>

                        <div v-if ="!item.includes('.pdf')" v-for="item in resultQuery" :key="item"  class="list-group-item" >
                            <a v-bind:href="'/showi/'+item" >{% item %}</a>
                            @if(! (Auth::user()->isUser() || Auth::user()->isSupervisor()))
                            <button class="btn btn-danger  float-right ml-2 active" @click="deleteFile(item, $event)" > Delete </button>
                            @endif
                        </div>
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
        new Vue({
        delimiters: ['{%', '%}'],
        el: '#app',
        data () {
            return {
            searchQuery: "",
            items: null,
            loading: true,
            errored: false,

            }
        },
        methods :{
            deleteFile : function(item , event) {
            event.preventDefault() // it prevent from page reload
            axios.delete('/delete_file/'+item)
                .then(response => {
                location.reload();
                }).catch(error => {
                            console.log(error)
                        }); 
        }
        },
        mounted () {
            axios
            .get('/files')
            .then(response => (this.items = response.data.filenames)).catch(error => {
                            console.log(error)
                            this.errored = true
                        })
                        .finally(() => this.loading = false)
        },
        computed: {
            resultQuery(){
            if(this.searchQuery){
            return this.items.filter((c)=>{
                return this.searchQuery.toLowerCase().split(' ').every(v => c.toLowerCase().includes(v))
            })
            }else{
                return this.items;
            }
            }
         },
        })
</script>
@endsection






