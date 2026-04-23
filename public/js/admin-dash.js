const panels = { welcome:'Bienvenida','profile-view':'Mi Perfil','profile-edit':'Editar Perfil','change-pass':'Cambiar Contraseña','posts-wall':'Muro','post-create':'Nueva Publicación','barbers-list':'Barberos','barber-register':'Registrar Barbero','agenda':'Agenda','schedule':'Asignar Horario','barberia':'Estado Barbería' };
function showPanel(id){
  document.querySelectorAll('.panel').forEach(p=>p.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n=>n.classList.remove('active'));
  const p=document.getElementById('panel-'+id); if(p){p.classList.add('active');}
  document.querySelectorAll('.nav-item').forEach(n=>{ if(n.getAttribute('onclick')&&n.getAttribute('onclick').includes("'"+id+"'")) n.classList.add('active'); });
  document.getElementById('topbarTitle').textContent = panels[id]||'';
  if(window.innerWidth<=768) closeSidebar();
}
function openSidebar(){ document.getElementById('sidebar').classList.add('open'); document.getElementById('sidebarOverlay').classList.add('show'); }
function closeSidebar(){ document.getElementById('sidebar').classList.remove('open'); document.getElementById('sidebarOverlay').classList.remove('show'); }
function updateClock(){ const n=new Date(); document.getElementById('clock').textContent=n.toLocaleTimeString('es-CO',{hour:'2-digit',minute:'2-digit'}); document.getElementById('dateStr').textContent=n.toLocaleDateString('es-CO',{weekday:'long',day:'numeric',month:'long'}); }
setInterval(updateClock,1000); updateClock();
let shopOpen=true;
function toggleShop(){
  shopOpen=!shopOpen;
  const s=document.getElementById('welcomeShopStatus'); const b=document.getElementById('welcomeToggleBtn');
  if(shopOpen){ s.className='shop-status shop-status--open'; s.innerHTML='<div class="status-dot status-dot--open"></div><span class="status-text status-text--open">ABIERTA</span><span class="status-sub">Desde las 8:00 AM</span>'; b.className='toggle-btn toggle-btn--close'; b.innerHTML='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><line x1="9" y1="9" x2="15" y2="15"/><line x1="15" y1="9" x2="9" y2="15"/></svg> Cerrar Barbería'; }
  else { s.className='shop-status shop-status--closed'; s.innerHTML='<div class="status-dot status-dot--closed"></div><span class="status-text status-text--closed">CERRADA</span><span class="status-sub">Reabre mañana</span>'; b.className='toggle-btn toggle-btn--open'; b.innerHTML='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg> Abrir Barbería'; }
}
function checkStrength(v){ const bar=document.getElementById('strBar'); const txt=document.getElementById('strText'); let s=0; if(v.length>=8)s++; if(/[A-Z]/.test(v))s++; if(/[0-9]/.test(v))s++; if(/[^A-Za-z0-9]/.test(v))s++; const w=['','25%','50%','75%','100%']; const c=['','#E25A4A','#C9A84C','#4A90E2','#4CAF6E']; const l=['','Muy débil','Regular','Buena','Fuerte']; bar.style.width=w[s]; bar.style.background=c[s]; txt.textContent=l[s]; txt.style.color=c[s]; }
function checkMatch(){ const p2=document.getElementById('cp2').value; const p3=document.getElementById('cp3').value; const m=document.getElementById('matchMsg'); if(!p3){m.textContent='';return;} if(p2===p3){m.textContent='✓ Las contraseñas coinciden';m.style.color='var(--green)';}else{m.textContent='✗ No coinciden';m.style.color='var(--red)';} }
function togglePwd(id,btn){ const i=document.getElementById(id); i.type=i.type==='password'?'text':'password'; }
function previewAvatar(e){ const f=e.target.files[0]; if(f){const r=new FileReader(); r.onload=ev=>{ const avatars=document.querySelectorAll('.avatar-lg'); avatars.forEach(a=>{a.style.backgroundImage=`url(${ev.target.result})`;}); }; r.readAsDataURL(f);} }
function previewPost(e){ const f=e.target.files[0]; if(f){ const r=new FileReader(); r.onload=ev=>{ document.getElementById('postPreviewImg').src=ev.target.result; document.getElementById('postPreview').style.display='block'; }; r.readAsDataURL(f); } }