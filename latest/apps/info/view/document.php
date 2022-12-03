<div class="subheader">
	<h1 class="subheader-title">
		<i class='subheader-icon fal fa-tag'></i> Documentation
		<small>
			คุ่มือการใช้งาน Ocean OS สำหรับ Programmer
		</small>
	</h1>
</div>
<div class="card mb-g">
	<div class="card-body">
		<h2 class="fw-700 m-0">
			Introduction to Oceanos Framework
			<small class="m-0">
				ระบบจัดการบริหาร Oceanos มีโครงสร้างจาก Maewnam Web UI ซึ่งพัฒนาโดย บริษัท แมวน้ำ เน็ตเวิร์ก โซลูชั่น จำกัด ลักษณะโครงสร้างโดยทั่วไปจะเป็นไปตามมาตรฐาน MCV 
				มีการจัดระเบียบที่เรียบง่ายและไม่ซับซ้อน ทำให้ผู้พัฒนาสามารถเขียนโปรแกรมใหม่ ๆ ได้หลากหลาย นอกจากนี้ยังใช้ Interface ที่พัฒนาขึ้นใหม่เป็นตัวควบคุมระบบ
				<br>
				เนื่องจากระบบมีความเรียบง่าย จึงทำให้นักพัฒนาทำงานได้หลายหลายทาง เราจำเป็นต้องมีข้อกำหนดร่วมกันดังต่อไปนี้
			</small>
		</h2>
		<hr class="my-5">
		<ul class="list-group">
			<li class="list-group-item">Concept of OceanOS Framework</li>
			<li class="list-group-item">MCV Structure</li>
			<li class="list-group-item">Database Design</li>
			<li class="list-group-item">Menu and Navigator</li>
			<li class="list-group-item">Authentication</li>
			<li class="list-group-item">Interface Controller</li>
			<li class="list-group-item">Software and License</li>
			<li class="list-group-item">System Operator</li>
		</ul>
		</div>
		
</div>
<div class="card mb-g">
	<div class="card-body">
		<h3 class="mt-2">1. Create Issue</h3>
			<p>ก่อนจะเริ่มต้นงานต้องแจ้งให้ Admin เปิด Issue ครั้ง</p>
			<div class="height-1 mb-3"></div>
		
		<h3>2. Install NPM</h3>
			<p>
				Npm is the package manager for JavaScript and the world’s largest software registry. Npm is a separate project from Node.js, and tends to update more frequently. As a result, even if you’ve just downloaded Node.js (and therefore npm), you’ll probably need to update your npm.
            </p>
                                <code class="bg-fusion-500 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">
			npm install npm@latest -g
		</code>
                                <p>
                                    Verify that npm in successfully installed, and version of installed npm will appear.
                                </p>
                                <code class="bg-fusion-500 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">
			npm --version
		</code>
                                <div class="height-1 mb-3"></div>
                                <h3>
                                    3. Install Gulp
                                </h3>
                                <p>
                                    Gulp is a toolkit that helps you automate your time-consuming tasks in development workflow. To install gulp globally.
                                </p>
                                <code class="bg-fusion-500 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">
			npm install gulp-cli -g
		</code>
                                <p>
                                    If you have previously installed a version of <code>gulp</code> globally, please remove it to make sure old version doesn't collide with new <code>gulp-cli</code>
                                </p>
                                <code class="bg-fusion-500 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">
			npm rm --global gulp
		</code>
                                <p>
                                    Verify that gulp in successfully installed, and version of installed gulp will appear.
                                </p>
                                <code class="bg-fusion-500 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">
			gulp --version
		</code>
                                <div class="height-1 mb-3"></div>
                                <h3>
                                    4. Install NPM Packages
                                </h3>
                                <p>
                                    NPM packages are a great way to ensure your files are up to date and everyone in your development tree is using the same version for the files. To install the npm you simple type:
                                </p>
                                <code class="bg-fusion-500 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-1">
			npm install
		</code>
                                <div class="mb-3 help-block">
                                    You may or may not see sime messages regarding vulnerabilities, we and the npm community, are aware of these issues and you can choose to ignore them or upgrade your jquery to the latest version (warning: doing so may break IE10 Datatables responsive plugin)
                                </div>
                                <p>
                                    Check outdated files and versions by typing:
                                </p>
                                <code class="bg-fusion-500 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">
			npm outdated
		</code>
                                <p>
                                    If you are updating the npm packages, please be sure to read their changelogs for any breaking changes before you do any major update. To update a package, simple open your package.json file and change the version number run <code>npm i</code> command
                                </p>
                                <div class="height-1 mb-3"></div>
                                <h3>
                                    5. Build project
                                </h3>
                                <p>
                                    Once all your NPM packages are installed you can now run the command to build your project. The build project will compile your project and create the necessary HTML files, CSS, and JS scripts related for each page. Once the compilation is completed, gulp will switch to 'watch' mode and watch for changes in your JS/HBS templates/SCSS files. Any changes you make, gulp will auto compile the project in seconds.
                                </p>
                                <code class="bg-fusion-500 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-1">
			gulp build
		</code>
                                <p>Once the compilation is complete, you can go to <a href="http://localhost:4000" target="_blank">http://localhost:4000</a> to view your compiled project</p>
                                <div class="height-1 mb-3"></div>
                                <h3>
                                    Other commands
                                    <small>
                                        We have built in other commands to help you fast track the project, these include:
                                    </small>
                                </h3>
                                <p>
                                    Gulp watch will initialize the file watch process and start the server
                                </p>
                                <code class="bg-fusion-500 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">
			gulp watch
		</code>
                                <p>
                                    Gulp build-nav will build the _nav.hbs file from your nav.json file
                                </p>
                                <code class="bg-fusion-500 d-block w-100 pt-2 pr-3 pb-2 pl-3 fw-700 mb-3">
			gulp build-nav
		</code>
                            </div>
</div>
	<div class="card mb-g">
                            <div class="card-body">
                                <h2 class="fw-700 mb-g">
                                    Build.json
                                    <small>
                                        Configure your project files <code>build.json</code>. You can completely slim down your project through the build.json file.
                                    </small>
                                </h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:260px">
                                                    variable
                                                </th>
                                                <th style="width: 100px">
                                                    value
                                                </th>
                                                <th>
                                                    description
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    config.debug
                                                </td>
                                                <td>
                                                    <code>boolean</code>
                                                </td>
                                                <td>
                                                    spits out debugging data and error messages on npm log file
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    config.data.*
                                                </td>
                                                <td>
                                                    <code>string</code>
                                                </td>
                                                <td>
                                                    global data for the template, control profile images, user names, etc
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    config.compile.jsUglify
                                                </td>
                                                <td>
                                                    <code>boolean</code>
                                                </td>
                                                <td>
                                                    minifies all javascript files in the project
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    config.compile.cssMinify
                                                </td>
                                                <td>
                                                    <code>boolean</code>
                                                </td>
                                                <td>
                                                    minifies all css files in the project
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    config.compile.jsSourcemaps
                                                </td>
                                                <td>
                                                    <code>boolean</code>
                                                </td>
                                                <td>
                                                    generates js source maps from the scss files for easier debugging options using the browser's inspection tool
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    config.compile.cssSourcemaps
                                                </td>
                                                <td>
                                                    <code>boolean</code>
                                                </td>
                                                <td>
                                                    generates css source maps from the scss files for easier debugging options using the browser's inspection tool
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    config.compile.autoprefixer
                                                </td>
                                                <td>
                                                    <code>boolean</code>
                                                </td>
                                                <td>
                                                    we recommend you leave this set to true. This will auto-generate all the necessary CSS browser prefixes for different browser types
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    config.compile.seedOnly
                                                </td>
                                                <td>
                                                    <code>boolean</code>
                                                </td>
                                                <td>
                                                    generates the seed project navigation menu, all other assets will be intact, can be removed manually (but will not be called into the main project)
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    config.path.*
                                                </td>
                                                <td>
                                                    <code>string</code>
                                                </td>
                                                <td>
                                                    addresses source and dist path of your porject files, change this if you change your source file path
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    build.vendor.*
                                                </td>
                                                <td>
                                                    <code>string</code>
                                                </td>
                                                <td>
                                                    link all sources for plugins from the node_modules directory, you can concatinte files here and also rename them if needed
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    build.app.*
                                                </td>
                                                <td>
                                                    <code>string</code>
                                                </td>
                                                <td>
                                                    concatinates all the main core files for the theme
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-g">
                            <div class="card-body">
                                <h2 class="fw-700 mb-g">
                                    app.config.js
                                    <small>
                                        Your <code>app.config.js</code> mainly controls the behaviour of your application, you can configure the navigation speed, disable visual effects, and change localstorage settings.
                                    </small>
                                </h2>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width:260px">
                                                    variable
                                                </th>
                                                <th style="width: 100px">
                                                    value
                                                </th>
                                                <th>
                                                    description
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    myapp_config.VERSION
                                                </td>
                                                <td>
                                                    <code>integer</code>
                                                </td>
                                                <td>
                                                    application version number
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    myapp_config.root_
                                                </td>
                                                <td>
                                                    <code>string</code>
                                                </td>
                                                <td>
                                                    used for core app reference
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    myapp_config.root_logo
                                                </td>
                                                <td>
                                                    <code>boolean</code>
                                                </td>
                                                <td>
                                                    used for core app reference to detect logo click behaviour
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    myapp_config.throttleDelay
                                                </td>
                                                <td>
                                                    <code>boolean</code>
                                                </td>
                                                <td>
                                                    for window.scrolling & window.resizing
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    myapp_config.filterDelay
                                                </td>
                                                <td>
                                                    <code>boolean</code>
                                                </td>
                                                <td>
                                                    keyup.functions for the search filter
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    myapp_config.mobileResolutionTrigger
                                                </td>
                                                <td>
                                                    <code>boolean</code>
                                                </td>
                                                <td>
                                                    the resolution when the mobile activation fires
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    myapp_config.debugState
                                                </td>
                                                <td>
                                                    <code>boolean</code>
                                                </td>
                                                <td>
                                                    outputs debug information on browser console
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    myapp_config.rippleEffect
                                                </td>
                                                <td>
                                                    <code>boolean</code>
                                                </td>
                                                <td>
                                                    global configuration for material design effect that appears on all buttons
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    myapp_config.mythemeAnchor
                                                </td>
                                                <td>
                                                    <code>string</code>
                                                </td>
                                                <td>
                                                    this anchor is created dynamically and CSS is loaded as an override theme
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    myapp_config.navAnchor
                                                </td>
                                                <td>
                                                    <code>string</code>
                                                </td>
                                                <td>
                                                    this is the root anchor point where the menu script will begin its build
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    myapp_config.navAccordion
                                                </td>
                                                <td>
                                                    <code>string</code>
                                                </td>
                                                <td>
                                                    nav item when one is expanded the other closes
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    myapp_config.navSpeed
                                                </td>
                                                <td>
                                                    <code>integer</code>
                                                </td>
                                                <td>
                                                    the rate at which the menu expands revealing child elements on click, lower rate reels faster expansion of nav childs
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    myapp_config.navClosedSign
                                                </td>
                                                <td>
                                                    <code>string</code>
                                                </td>
                                                <td>
                                                    main nav close sign
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    myapp_config.navOpenedSign
                                                </td>
                                                <td>
                                                    <code>string</code>
                                                </td>
                                                <td>
                                                    main nav open sign
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    myapp_config.storeLocally
                                                </td>
                                                <td>
                                                    <code>boolean</code>
                                                </td>
                                                <td>
                                                    saveSettings to localStorage, to store settings to a DB instead of LocalStorage use initApp.pushSettings("className1 className2")
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-g">
                            <div class="card-body">
                                <h2 class="fw-700 mb-g">
                                    File Structure
                                    <small>
                                        This webapp toolkit comes with a flexible file structure that can be easily used for small to large scope projects. This section will explains app's file structure and how to adapt it to your project.
                                    </small>
                                </h2>
                                <ul>
                                    <li>_resources</li>
                                    <li>smartadmin-html-full
                                        <ul>
                                            <li>build</li>
                                            <li>dist (auto generated)</li>
                                            <li>src
                                                <ul>
                                                    <li>content</li>
                                                    <li>custom
                                                        <ul>
                                                            <li>demo-data</li>
                                                            <li>docs-data</li>
                                                            <li>lang</li>
                                                            <li>media</li>
                                                            <li>plugins</li>
                                                            <li>webfonts</li>
                                                        </ul>
                                                    </li>
                                                    <li>image</li>
                                                    <li>js</li>
                                                    <li>scss
                                                        <ul>
                                                            <li>_extensions</li>
                                                            <li>_imports</li>
                                                            <li>_mixins</li>
                                                            <li>_modules</li>
                                                            <li>...</li>
                                                        </ul>
                                                    </li>
                                                    <li>template
                                                        <ul>
                                                            <li>layouts</li>
                                                            <li>include</li>
                                                            <li>_helpers</li>
                                                        </ul>
                                                    </li>
                                                    <li>navigation.json</li>
                                                </ul>
                                            </li>
                                            <li>build.json</li>
                                            <li>package.json</li>
                                        </ul>
                                    </li>
                                    <li>smartadmin-html-seed</li>
                                    <li>tests</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card mb-g">
                            <div class="card-body">
                                <h3 class="fw-500">
                                    Plugin reference
                                    <small>
                                        Reference for all plugins within SmartAdmin WebApp
                                    </small>
                                </h3>
                                <select class="js-plugins custom-select form-control mb-g" style="width:15rem;">
                                    <option value="">-- Select Plugin --</option>
                                </select>
                                <div id="js-display" class="d-none">
                                    <p>
                                        <strong>Plugin Name:</strong> <span class="js-plugin-name"></span>
                                    </p>
                                    <p>
                                        <span class="js-plugin-description"></span>
                                    </p>
                                    <p>
                                        <strong>Documentation:</strong>
                                        <br>
                                        <a href="" class="js-plugin-url" target="_blank"></a>
                                    </p>
                                    <p>
                                        <strong>License:</strong>
                                        <br>
                                        <span class="js-plugin-license"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-g">
                            <div class="card-body">
                                <h3 class="fw-500">
                                    Product Support
                                    <small>
                                        Customer support for SmartAdmin WebApp
                                    </small>
                                </h3>
                                <p>All support questions related to HTML and/or CSS will be honored. Issues that are encountered on the Seed versions of specific flavors of SmartAdmin are covered by their <a href="https://www.gotbootstrap.com/intel_introduction.html" target="_blank">respective authors</a>, but will be limited to HTML and/or CSS issues. If you need assistance with a technical issue that is currently not covered by the FAQ, you will need to have purchased a Full license of that flavor and contact the respective author for further assistance. The Full version links will be added to the <a href="https://www.gotbootstrap.com/info_app_flavors.html" target="_blank">Flavors</a> page once they are made available.</p>
                            </div>
                        </div>