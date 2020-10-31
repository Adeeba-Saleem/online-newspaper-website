    <!--   Weekly-News start --><!-- Whats New Start -->
    <section class="whats-news-area pt-50 pb-20">
        <div class="container">
      
                <div class="row d-flex justify-content-between">
                    <div class="col-lg-3 col-md-3">
                        <div class="section-tittle mb-30">
                            <h3>Top four popular News</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class='tab-content' id='nav-tabContent'>
                            <!-- card one -->
                            <div class='tab-pane fade show active' id='nav-home' role='tabpanel' aria-labelledby='nav-home-tab'>           
                                <div class='whats-news-caption'>
                                    <div class='row'>
                        <!-- Nav Card -->
               <?php $post_obj-> getRecentNews(); ?>
                    <!-- End Nav Card -->
                    </div>  </div>
                            </div>
                            </div>           
                        </div>
                </div>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-3"></div>
                    <div class="col-3">
                        <div class="chatbox-holder">
 
  
  <div class="chatbox chatbox-min">
    <div class="chatbox-top">
      <div class="chatbox-avatar">
        <a href="index.php"><img src="assets/img/logo/logo.png" /></a>
      </div>
      <div class="chat-partner-name">
        <span class="status donot-disturb" style="background-color: rgb(4, 180, 4);"></span>
        <a  href="index.php" >CHAT BOT</a>
      </div>
      <div class="chatbox-icons">
        <a href="javascript:void(0);"><i class="fa fa-minus"></i></a>
        <a href="javascript:void(0);"><i class="fa fa-close"></i></a>       
      </div>      
    </div>
    
    <div class="chat-messages">
     
       <div class="body" id="chatbody">
                <div class="scroller"></div>
            </div> 
    </div>
    
   <form method="POST" autocomplete="off" class="chat">
      <div class="chat-input-holder">
        <input type="text" name="chat" id="chat" placeholder="Chat Box" class="chat-input">
      <input type="submit" value="Send" id="btn" class="message-send" />
    </div>

    </form>
    
    <div class="attachment-panel">
      
    </div>
  </div>
 <script>
   const btnSend = document.getElementById("btn");
const chat = document.getElementById("chat");

const getMessage = (msg) => {
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      const response = xhr.responseText;
      const chatBody = document.querySelector(".scroller");
      const divCpu = document.createElement("div");
      divCpu.className = "alicia visible";
      divCpu.innerHTML = response;
      const divUser = document.createElement("div");
      divUser.className = "me visible";
      divUser.textContent = msg;
      chatBody.append(divUser);
      setTimeout(() => {
        chatBody.append(divCpu);
      }, 600);
      //   console.log(divCpu);
    }
  };
  xhr.open("GET", "pages/bot/chat.php?msg=" + msg, true);
  xhr.send();
};

btnSend.addEventListener("click", (e) => {
  e.preventDefault();
  if (chat.value == "") {
  } else {
    getMessage(chat.value);
    chat.value = "";
  }
});

 </script>
</div>

                        
                    </div>
                </div>
        </div>
    </section>
    <!-- Whats New End -->
       
    <!-- End Weekly-News -->
