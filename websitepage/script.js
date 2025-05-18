 // SCROLL TO TOP BUTTON
 let topBtn = document.getElementById("topBtn");

 window.onscroll = function () {
   if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
     topBtn.style.display = "block";
   } else {
     topBtn.style.display = "none";
   }
 };
 
 topBtn.onclick = function () {
   window.scrollTo({ top: 0, behavior: 'smooth' });
 };
 
 // COUNTDOWN TIMER
 const countdownEl = document.getElementById("countdown");
 const countdownDate = new Date("April 30, 2025 23:59:59").getTime();  // ✅ fixed date format
 
 const updateCountdown = () => {
   const now = new Date().getTime();
   const distance = countdownDate - now;
 
   if (distance <= 0) {
     countdownEl.innerHTML = "🔥 Event has started!";
     clearInterval(countdownInterval);
     return;
   }
 
   const days = Math.floor(distance / (1000 * 60 * 60 * 24));
   const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
   const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
   const seconds = Math.floor((distance % (1000 * 60)) / 1000);
 
   countdownEl.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
 };
 
 const countdownInterval = setInterval(updateCountdown, 1000);
 updateCountdown();
 
 // MODAL OPEN/CLOSE
 const modal = document.getElementById("registerModal");
 const closeModal = document.getElementById("closeModal");
 const openBtns = document.querySelectorAll(".openModalBtn");
 
 openBtns.forEach((btn) =>
   btn.addEventListener("click", () => {
     modal.style.display = "block";
   })
 );
 
 closeModal.addEventListener("click", () => {
   modal.style.display = "none";
 });
 
 window.addEventListener("click", (event) => {
   if (event.target === modal) {
     modal.style.display = "none";
   }
 });
 
 // HORIZONTAL SLIDER MOUSE SWIPE
 const slider = document.getElementById('tournamentSlider');
 let isDown = false;
 let startX;
 let scrollLeft;
 
 slider.addEventListener('mousedown', (e) => {
   isDown = true;
   slider.classList.add('active');
   startX = e.pageX - slider.offsetLeft;
   scrollLeft = slider.scrollLeft;
 });
 
 slider.addEventListener('mouseleave', () => {
   isDown = false;
   slider.classList.remove('active');
 });
 
 slider.addEventListener('mouseup', () => {
   isDown = false;
   slider.classList.remove('active');
 });
 
 slider.addEventListener('mousemove', (e) => {
   if (!isDown) return;
   e.preventDefault();
   const x = e.pageX - slider.offsetLeft;
   const walk = (x - startX) * 2;
   slider.scrollLeft = scrollLeft - walk;
 });

  

















 