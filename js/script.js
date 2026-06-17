(function(){
  const menuBtn=document.getElementById('menuBtn');
  const mobileNav=document.getElementById('mobileNav');
  if(menuBtn&&mobileNav){
    menuBtn.addEventListener('click',()=>{
      const open=mobileNav.classList.toggle('open');
      menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
    mobileNav.querySelectorAll('a').forEach(a=>a.addEventListener('click',()=>{
      mobileNav.classList.remove('open');
      menuBtn.setAttribute('aria-expanded','false');
    }));
  }
  const cookie=document.getElementById('cookieBanner');
  const accept=document.getElementById('acceptCookie');
  if(cookie && !localStorage.getItem('phoenix_cookie_ok')) cookie.classList.add('show');
  if(accept) accept.addEventListener('click',()=>{localStorage.setItem('phoenix_cookie_ok','1');cookie.classList.remove('show')});
  const form=document.getElementById('request');
  if(form){
    form.addEventListener('submit',e=>{
      if(location.hostname.includes('github.io') || location.protocol==='file:'){
        e.preventDefault();
        alert('Тестовый режим: форма визуально работает. На хостинге R01 заявки будут отправляться на info@fenix.moscow через contact.php.');
      }
    });
  }
})();
