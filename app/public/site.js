const menu=document.querySelector('.menu-toggle'),nav=document.querySelector('#navigation');
menu?.addEventListener('click',()=>{const open=menu.getAttribute('aria-expanded')!=='true';menu.setAttribute('aria-expanded',String(open));nav.classList.toggle('open',open)});
nav?.querySelectorAll('a').forEach(a=>a.addEventListener('click',()=>{nav.classList.remove('open');menu.setAttribute('aria-expanded','false')}));
let category='Tất cả';const search=document.querySelector('#catalog-search'),filters=document.querySelectorAll('.filter'),products=document.querySelectorAll('.product');
function filterProducts(){let count=0;const term=(search?.value||'').toLocaleLowerCase('vi');products.forEach(card=>{const show=(category==='Tất cả'||card.dataset.category===category)&&card.dataset.name.toLocaleLowerCase('vi').includes(term);card.hidden=!show;if(show)count++});document.querySelector('.empty-state').hidden=count>0;}
filters.forEach(button=>button.addEventListener('click',()=>{category=button.dataset.category;filters.forEach(b=>{b.classList.toggle('selected',b===button);b.setAttribute('aria-pressed',String(b===button))});filterProducts()}));
search?.addEventListener('input',filterProducts);
document.querySelector('.search-toggle')?.addEventListener('click',()=>{document.querySelector('.search-box').hidden=false;document.querySelector('#demo').scrollIntoView({behavior:'smooth'});search.focus()});
document.querySelector('.show-all')?.addEventListener('click',()=>{search.value='';filters[0].click();document.querySelector('.product-grid').scrollIntoView({behavior:'smooth'})});
const track=document.querySelector('.project-track');
document.querySelector('.slider-next')?.addEventListener('click',()=>track.scrollBy({left:track.clientWidth*.8,behavior:'smooth'}));
document.querySelector('.slider-prev')?.addEventListener('click',()=>track.scrollBy({left:-track.clientWidth*.8,behavior:'smooth'}));
