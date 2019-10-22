require('./bootstrap');

Vue.component('github-users-item',{
    template: "#user-template",
    props: ['user']
});


Vue.component('search-form', {
    template:'#search-form'
});
new Vue({
    el: "#root",
    data: {
        users: [],
        fetched: false,
        endpoint: '/api/users',
        searchText: '',
        searched: false,
        found: false
    },
    methods: {
        shuffle(){
            console.log("Shuffling array");
            this.users.sort((x, y) => Math.random() > .5 ? -1 : 1);
        },
        search(){
           if(this.searchText !== '')
           {
               this.endpoint = `/api/search/${this.searchText}`;
               this.searched = true;
           }else{
               this.endpoint = '/api/users';
           }
           
           this.fetchData();
           if(!this.users.length === 0){
                this.found = true;
            }
        },
        fetchData(){
           axios.get(this.endpoint)
            .then(({data}) => {

                this.fetched = true;
                this.users = data.items ? data.items : data;
            })
           .catch(error => {
              console.log(error);
         });
        }
    },
    created: function() {
        this.fetchData();
    }
});