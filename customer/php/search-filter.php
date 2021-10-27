<form action="#" autocomplete="off">
          <div class="row">
            <div class="col-xl-4 col-md-6 mb-4 ">
              <label class="form-label" for="form_dates">Dates</label>
              <div class="datepicker-container datepicker-container-left">
                <input class="form-control  input-group btn-pill bg-white shadow-soft border-light" type="text" name="bookingDate" id="form_dates"
                  placeholder="Choose your dates">
              </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <label class="form-label" for="form_guests">Guests</label>
              <select class="form-select input-group btn-pill bg-white  shadow-soft border-light" name="guests" id="form_guests" 
                title=" ">
                <option value="guests_0">1 </option>
                <option value="guests_1">2 </option>
                <option value="guests_2">3 </option>
                <option value="guests_3">4 </option>
                <option value="guests_4">5 </option>
              </select>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <label class="form-label" for="form_type">Room type</label>
              <select class="form-select input-group btn-pill bg-white shadow-soft border-light" name="guests" id="form_guests" 
              title=" ">
                <option value="type_0">Any </option>
                <option value="type_1">Standard suite </option>
                <option value="type_2">Queen suite</option>
                <option value="type_3">King suite</option>
              </select>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
              <label class="form-label">Price range</label>
              <div class="text-primary" id="slider-snap"></div>
              <div class="nouislider-values">
                <div class="min">From $<span id="slider-snap-value-from"></span></div>
                <div class="max">To $<span id="slider-snap-value-to"></span></div>
              </div>
              <input type="hidden" name="pricefrom" id="slider-snap-input-from" value="40">
              <input type="hidden" name="priceto" id="slider-snap-input-to" value="300">
            </div>
            <div class="col-md-6 col-lg-12 col-xl-8 mb-4 d-xl-flex justify-content-center">
              <div>
                <label class="form-label">Amentities</label>
                <ul class="list-inline mb-0 mt-1">
                  <li class="list-inline-item">
                    <div class="form-check form-switch">
                      <input class="form-check-input " id="" type="checkbox">
                      <label class="form-check-label" for=""> <span class="text-sm">Wifi</span></label>
                    </div>
                  </li>
                  <li class="list-inline-item">
                    <div class="form-check form-switch">
                      <input class="form-check-input " id="superhost" type="checkbox">
                      <label class="form-check-label" for="superhost"> <span class="text-sm">Some amentities</span></label>
                    </div>
                  </li>
                  <li class="list-inline-item">
                    <div class="form-check form-switch">
                      <input class="form-check-input " id="superhost" type="checkbox">
                      <label class="form-check-label" for="superhost"> <span class="text-sm">Some amentities</span></label>
                    </div>
                  </li>
                  <li class="list-inline-item">
                    <div class="form-check form-switch">
                      <input class="form-check-input " id="superhost" type="checkbox">
                      <label class="form-check-label" for="superhost"> <span class="text-sm">Some amentities</span></label>
                    </div>
                  </li>
                  <li class="list-inline-item">
                    <div class="form-check form-switch">
                      <input class="form-check-input " id="superhost" type="checkbox">
                      <label class="form-check-label" for="superhost"> <span class="text-sm">Some amentities</span></label>
                    </div>
                  </li>
                  <li class="list-inline-item">
                    <div class="form-check form-switch">
                      <input class="form-check-input " id="superhost" type="checkbox">
                      <label class="form-check-label" for="superhost"> <span class="text-sm">Some amentities</span></label>
                    </div>
                  </li>
                  <li class="list-inline-item">
                    <div class="form-check form-switch">
                      <input class="form-check-input " id="superhost" type="checkbox">
                      <label class="form-check-label" for="superhost"> <span class="text-sm">Some amentities</span></label>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 mb-4 order-2 order-sm-1">
              <button class="btn btn-primary shadow-soft border-light animate-up-2" type="submit"> <i class="fas fa-search me-1"></i>Search </button>
            </div>
          </div>
        </form>