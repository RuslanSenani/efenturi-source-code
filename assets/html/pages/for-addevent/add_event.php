<!----------- add event start --------->
<section>
    <div class="container m-auto">
        <div class='for-numbers'>
            <ul>
                <li class='active'>
                    <span>1</span>
                </li>
                <li>
                    <span>2</span>
                </li>
                <li>
                    <span>3</span>
                </li>
                <li>
                    <span>4</span>
                </li>
               
            </ul>
        </div>
        <div class="col-lg-8 col-md-12 col-sm-12 col-12 m-auto">
            <form action="addevent.php" method='POST'>
                <div class="form-one for-all" id="b1">
                    <div class="city_country">
                        <div class="form-group">
                            <label>Ölkə*</label>
                            <select name="country">
                                <option></option>
                            </select>
                            <div id="country"></div>
                        </div>
                        <div class="form-group">
                            <label>Şəhər*</label>
                            <select name="city">
                                <option></option>
                            </select>
                            <div id="city"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Event adı*</label>
                        <input type="text" name='name'>
                        <div id="name"></div>
                    </div>
                    <div class="form-group">
                        <label>Event tarixi*</label>
                        <input type="date" name="date">
                        <div id="date"></div>
                    </div>
                    <div class="form-group">
                        <label>Event saatı*</label>
                        <input type="time" name="time">
                        <div id="time"></div>
                    </div>
                </div>
                <div class="form-two for-all" id="b2">
                    <div class="event-strem">
                        <div class="form-group">
                            <label>Event Venue*</label>
                            <select name="venue"></select>
                            <div id="venue"></div>
                        </div>
                        <div class="form-group">
                            <label>Stream Type*</label>
                            <select name="stream-type">
                                <option></option>
                            </select>
                            <div id="stream-type"></div>
                        </div>
                    </div>
                    <div class="event-status-type">
                        <div class="form-group">
                            <label>Event Status*</label>
                            <select name="status"></select>
                            <div id="status"></div>
                        </div>
                        <div class="form-group">
                            <label>Event Type*</label>
                            <select name="event-type">
                                <option></option>
                            </select>
                            <div id="event-type"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Sənaye</label>
                        <select name="industry">
                            <option></option>
                        </select>
                        <div id="industry"></div>
                    </div>
                </div>
                <div class="form-three for-all" id="b3">
                    <div class="email-tel">
                        <div class="form-group">
                            <label for="">Email*</label>
                            <input type="email" name="email">
                            <div id="email"></div>
                        </div>
                        <div class="form-group">
                            <label>Telefon*</label>
                            <input type="tel" name="telephone">
                            <div id="telephone"></div>
                        </div>
                    </div>
                    <div class="website-logo">
                        <div class="form-group">
                            <label>Event Website*</label>
                            <input type='url' name='web'></input>
                            <div id="web"></div>
                        </div>
                        <div class="form-group">
                            <label>Event logo*</label>
                            <input type='url' name='logo'></input>
                            <div id="logo"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Event haqqında ətraflı məlumat*</label>
                        <textarea name="message" cols="30" rows="10"></textarea>
                        <div id="message"></div>
                    </div>
                </div>
                <div class="form-four for-all" id="b4">
                    <div class="form-group">
                        <label>Sosial şəbəkə linkləri*</label>
                        <input type="url" name="social-network">
                        <div id="social-network"></div>
                    </div>
                    <div class="form-group">
                        <label>Map-link*</label>
                        <input type="url" name="map">
                        <div id="map"></div>
                    </div>
                    <div class="form-group">
                        <label>Event video/link*</label>
                        <input type="url" name="video-link">
                        <div id='video-link'></div>
                    </div>
                    <div class="form-group">
                        <label>Tag</label>
                        <input type="text" name="event-tag">
                        <div id='event-tag'></div>
                    </div>
                    <div class="from-group for-chechbox">
                        <div>
                            <label>
                                <input type="checkbox" name="check" />
                                <img src="img/main-page-img/world.svg">
                                <span>Block</span>
                            </label>
                        </div>
                        <div>
                            <label>
                                <input type="checkbox" name="check" />
                                <img src="img/main-page-img/world.svg">
                                <span>Block</span>
                            </label>
                        </div>
                        <div>
                            <label>
                                <input type="checkbox" name="check" />
                                <img src="img/main-page-img/world.svg">
                                <span>Block</span>
                            </label>
                        </div>
                        <div>
                            <label>
                                <input type="checkbox" name="check">
                                <img src="img/main-page-img/world.svg">
                                <span>Block</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row add-events-button">
                    <button class="btn btn-info prev">Prev
                        <i class="fas fa-angle-left"></i>
                    </button>
                    <button class="btn btn-info">Submit</button>
                    <button class="btn btn-info next">Next
                        <i class="fas fa-angle-right"></i>
                    </button>

                </div>
            </form>
        </div>
    </div>
</section>
<!----------- add event end ----------->