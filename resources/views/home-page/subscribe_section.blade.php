<section class="subscribe_section">
    <div class="container-fuild">
       <div class="box">
          <div class="row">
             <div class="col-md-6 offset-md-3">
                <div class="subscribe_form ">
                   <div class="heading_container heading_center">
                      <h3>Subscribe To Get Discount Offers</h3>
                   </div>
                   <p>By subscribing you will be notifited with the latest news about product arrivals and discount offers.</p>
                   <form action="add_email" method="POST">
                     @csrf
                      <input type="email" placeholder="Enter your email" name="email">
                      <button type="submit">subscribe</button>
                   </form>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>