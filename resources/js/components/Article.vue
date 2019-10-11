<template>
	<div>
		<div class="container mt-4">
			<h1 class="text-center">
				Laravel 6 + VueJs
			</h1>
				<hr>

				<div class="card card-body mb-4">	
					<form @submit.prevent="createArticle">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="title">Title</label>
									<input type="text" name="title" id="title" class="form-control" v-model="article.title">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="body">Body</label>
									<textarea id="body" class="form-control" v-model="article.body"></textarea>
								</div>
							</div>
						</div>

						<button type="submit" class="btn btn-primary btn-flat">Submit</button>
					</form>
				</div>
			
				<nav class="mt-4">
	        <ul class="pagination">
	          <li v-bind:class="[{ disabled: !pagination.prev_page_url}]" class="page-item">
              <a href="#" @click="fetchArticles(pagination.prev_page_url)" class="page-link">Previous</a>
	          </li>    
	          <li class="page-item"><a href="#" class="page-link disabled text-dark">{{ pagination.current_page }} of {{ pagination.last_page }}</a></li>

	          <li v-bind:class="[{ disabled: !pagination.next_page_url}]" class="page-item">
              <a href="#" @click="fetchArticles(pagination.next_page_url)" class="page-link">Next</a>
	          </li>  
	        </ul>    
        </nav>

				<div class="card mb-4" v-for="(article, index) in articles" v-bind:key="index">
					<div class="card-header bg-info text-white">
						<div class="card-title">
							<h4>{{ article.title }}</h4>
						</div>
					</div>

					<div class="card-body">
						{{ article.body }}
					</div>

					<div class="card-footer">
						<button @click="editArticle(article)" class="btn btn-warning">Edit</button>
						<button @click="deleteArticle(article.id)" class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		data() {
			return {
				articles: [],
				article: {
					id: null,
					title: null,
					body: null,
					article_id: null,
				},
				edit: false,
				pagination: {},
			}
		},

		created() {
			this.fetchArticles()
		},

		methods: {
			// Fetch Articles
			fetchArticles(page_url) {
				let vm = this
        page_url = page_url || 'api/articles'
				fetch(page_url)
				  .then(articles => articles.json())
				    .then(articles => {
				    	this.articles = articles.data
				    	vm.makePagination(articles.meta, articles.links)
				    }).catch(err => console.log(err))
			},

			// Paginate Article
			makePagination(meta, links){
        let pagination = {
	        current_page: meta.current_page,
	        last_page: meta.last_page,
	        next_page_url: links.next,
	        prev_page_url: links.prev
        };
        this.pagination = pagination;
      },

      // Buat Artikel Baru
      createArticle() {
      	if(this.edit == false) {
	      	fetch('api/article', {
	      		method: 'POST',
	      		body: JSON.stringify(this.article),
	      		headers: {
	      			'Content-Type': 'Application/json'
	      		}
	      	})
	      		.then(article => article.json())
	      			.then(article => {
	      				this.article.title = null
	      				this.article.body = null
	      				this.fetchArticles()
	      				alert('Article Berhasil Dibuat')
	      			})
	      				.catch(err => console.log(err))
  			} else {
  				fetch('api/article', {
  					method: 'PUT',
  					body: JSON.stringify(this.article),
  					headers: {
  						'Content-Type': 'Application/json'
  					}
  				})
  					.then(article => article.json())
  					  .then(article => {
  					  	this.article.title = null
  					  	this.article.body = null
  					  	this.article.article_id = null
  					  	this.article.id = null
  					  	this.edit = false
  					  	alert('Article Updated')
  					  	this.fetchArticles()
  					  })
  					  	.catch(err => console.log(err))
  			}
      },

      // Edit Article Form
      editArticle(article) {
      	this.edit = true
      	this.article.id = article.id
      	this.article.article_id = article.id
      	this.article.title = article.title
      	this.article.body = article.body
      },

      // Hapus Artikel
      deleteArticle(id) {
	      if(confirm('Hapus Artikel ?')) {
	      	fetch(`api/article/${id}`, {
	      		method: 'DELETE',
	      	})
	      	  .then(article => article.json())
	      	  	.then(article => {
	      	  		this.article.title = null
  					  	this.article.body = null
	      	  		this.fetchArticles()
	      				alert('Artikel Berhasil Dihapus')
	      	  	})	
	      	  	  .catch(err => console.log(err))
  	  	}
      }
		}
	}
</script>