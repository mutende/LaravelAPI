<template>
<div>
    <h2>Articles</h2>
    <form @submit.prevent="addArticle" class="mb-3">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Title" v-model="article.title">
        </div>

         <div class="form-group">
            <textarea type="text" class="form-control" placeholder="Body" v-model="article.body"></textarea>
        </div>
        <button  class="btn btn-sm btn-info btn-block" type="submit">Save</button>

    </form>
    <nav aria-label="Page navigation example" class="mt-5">
  <ul class="pagination">
    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
        <a class="page-link" href="#" @click="fetchData(pagination.prev_page_url)">Previous</a>
    </li>
   

       <li class="page-item disabled"><a class="page-link text-dark" href="#"> Page {{pagination.current_page}} of {{pagination.last_page}}</a></li>


    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
        <a class="page-link" href="#" @click="fetchData(pagination.next_page_url)">Next</a>
    </li>
  </ul>
</nav>
    <div class="card card-body mb-3" v-for="article in articles" v-bind:key="article.id">
        <h3>{{ article.title}}</h3>
        <p>{{ article.body }}</p>

        <hr>
         <button @click="editArticle(article)" class="btn btn-primary mb-2"> Edt</button>
        <button @click="deleteArticle(article.id)" class="btn btn-danger"> Delete</button>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {

            articles: [],
            article: {
                id: '',
                title: '',
                body: ''
            },
            id: '',
            pagination: {},
            edit: false

        }
    },
    created() {
        this.fetchData();
    },

    methods: {
        fetchData(page_url) {
            page_url = page_url || 'api/articles'
            let vm = this
            fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.articles = res.data
                    vm.makePagination(res.meta, res.links)
                })
                .catch(err => console.log(err))
        },
        makePagination(meta, links){
            let pagination = {
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            }

            this.pagination = pagination
        },
        deleteArticle(id){
         if(confirm('Are you sure you want to delete')){

            fetch(`api/article/${id}`, {
                method: 'delete'
            })
            .then(res => res.json())
            .then(data => {
                alert('Article Deleted')
                this.fetchData()
            })
            .catch(res => console.log(res))
        }
     },
     addArticle(){
         if(this.edit === false){
             //add
             fetch('api/article',{
                 method: 'post',
                 body: JSON.stringify(this.article),
                 headers:{
                     'content-type':'application/json'
                 }
             })
             .then(res => res.json())
             .then(data => {
                 this.article.title = ''
                 this.article.body = ''
                 alert('Article Created')
                  this.fetchData()
             })
             .catch(err => console.log(err))
         }else{
            //  update
            fetch('api/article',{
                 method: 'put',
                 body: JSON.stringify(this.article),
                 headers:{
                     'content-type':'application/json'
                 }
             })
             .then(res => res.json())
             .then(data => {
                 this.article.title = ''
                 this.article.body = ''
                 alert('Article Updated')
                 this.fetchData()
             })
             .catch(err => console.log(err))
         }
     },
     editArticle(article){
         this.edit = true
         this.article.id = article.id
         this.id = article.id
         this.article.title = article.title
         this.article.body = article.body
     }

    }
}
</script>
