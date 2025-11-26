<form action="#" method="post">
    <div class="input-group mb-3">
       <input type="text" class="form-control" placeholder="Username" name="tuser" required/>
       <div class="input-group-text"><span class="bi bi-person"></span></div>
    </div>
    <div class="input-group mb-3">
       <input type="password" class="form-control" placeholder="Password" name="tpass" required/>
       <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
    </div>
    <!-begin:: Row->
    <div class="row">
      <div class="col-8">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
          <label class="form-check-label" for="flexCheckDefault"> Remember Me </label>
        </div>
     </div>
     <div class="col-4">
       <div class="d-grid gap-2">
         <input type="submit" class="btn btn-primary" value="Sign In" name="btnLogin"/>
       </div>
     </div>
    </div>
  </form>