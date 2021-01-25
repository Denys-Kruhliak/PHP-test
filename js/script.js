//let postDelBtns = document.getElementsByClassName('delete-post');
let postDelBtns = document.querySelectorAll('.delete-post');
//console.log(postDelBtns);

for(let btn of postDelBtns){
    btn.addEventListener('click',function(e){
        e.preventDefault();
        let id = e.target.dataset.id;
        //console.log(id);
        axios({
            method: 'post',
            url: '/post/delete',
            data: `id=${id}`
        }).then(response=>{
            //console.log('id =',response.data);
            e.target.parentElement.parentElement.remove();
        })
    })
}