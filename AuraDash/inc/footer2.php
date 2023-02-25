<footer class="iq-footer">
    <div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="../backend/privacy-policy.php">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="../backend/terms-of-service.php">Terms of Use</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 text-right">
                    <span class="mr-1"><script>document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">AURA Dash</a>.
                </div>
            </div>
        </div>
    </div>
</div>
</footer>
<!-- Backend Bundle JavaScript -->
<script src="../assets/js/backend-bundle.min.js"></script>

<!-- Table Treeview JavaScript -->
<script src="../assets/js/table-treeview.js"></script>

<!-- Chart Custom JavaScript -->
<script src="../assets/js/customizer.js"></script>

<!-- Chart Custom JavaScript -->
<script async src="../assets/js/chart-custom.js"></script>

<!-- app JavaScript -->
<script src="../assets/js/app.js"></script>

<script>
    function Validator(options){ 
        // Lấy thuộc tính của thẻ cha của element (trường hợp sd cho nhiều trang web)
        function getParent(element, selector){
            while(element.parentElement){
                if(element.parentElement.matches(selector)){
                    return element.parentElement;
                }
                element = element.parentElement;
            }
        }
        var selectorRules = {};
        // Hàm thực hiện validate
        function validate(inputElement, rule){
            var errorElement = getParent(inputElement, options.parentSelector).querySelector(options.errorSelector);
            var errorMessage;
            // Lấy ra các rules của selector
            var rules = selectorRules[rule.selector];
            // Lặp qua từng rule và kiểm tra nếu có lỗi thì dừng
            for(var i =0; i < rules.length; ++i){
                errorMessage = rules[i](inputElement.value);
                if(errorMessage) break;
            }
        if(errorMessage){
            errorElement.innerText = errorMessage;
            getParent(inputElement, options.parentSelector).classList.add('invalid');
            } else{
                errorElement.innerText = ''
                getParent(inputElement, options.parentSelector).classList.remove('invalid');
                }
            return !errorMessage;
        }
        // Lấy element của form cần validate
        var formElement = document.querySelector(options.form);
            
        if(formElement){

            // Khi submit form
            formElement.onsubmit = function(e){
                
                var isFormValid = true;

                // Lặp qua từng rules và validate(Kiểm tra) xem có lỗi không
                options.rules.forEach(function(rule){
                    var inputElement = formElement.querySelector(rule.selector);
                    var isValid = validate(inputElement,rule);
                    if(!isValid){
                        isFormValid = false;
                        e.preventDefault();
                    }
                });
            }
        }

            // Lặp qua mỗi rule và xử lý (lắng nghe sự kiện onblur, input,...)
            options.rules.forEach(function(rule){

                // Lưu lại các rules cho mỗi input
                if(Array.isArray(selectorRules[rule.selector])){
                    selectorRules[rule.selector].push(rule.test);
                }else{
                    selectorRules[rule.selector] = [rule.test];
                    }

                // Khai báo inputElements là một nodelist nhiều rule
                var inputElements = formElement.querySelectorAll(rule.selector);
                // Chuyển nodelist thành dạng mảng và lặp qua để lấy từng rule trong inputElements và xử lí
                Array.from(inputElements).forEach(function(inputElement){
                    // Xử lý khi người dùng blur
                    inputElement.onblur = function(){
                        validate(inputElement,rule);
                        }
                    // Xử lý khi người dùng nhập
                    inputElement.oninput = function(){
                        var errorElement = getParent(inputElement, options.parentSelector).querySelector(options.errorSelector);
                        errorElement.innerText = '';
                        getParent(inputElement, options.parentSelector).classList.remove('invalid');
                    }
                });
                });
        }

        // Định nghĩa hàm phụ
        Validator.isRequired = function(selector){
        return {
            selector,
            test: function(value){
                return value? undefined : 'Vui lòng nhập trường này';
            }
        }
        }

        Validator.isFullname = function(selector){
        return {
            selector,
            test: function(value){
                return  /^(?=.*\d)(?=.*[a-z]).{5,10}$/.test(value)? undefined : 'Tên tài khoản bắt buộc từ 5-10 ký tự, phải chứa chữ thường và chữ số';
            }
        }
        }

        Validator.isEmail = function(selector){
        return {
            selector,
            test: function(value){
                var regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                return regex.test(value)? undefined : 'Vui lòng nhập đúng định dạng email';
            }
        }
        }

        Validator.isPassword = function(selector, test){
        return {
            selector,
            test: function(value){
                // /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,16}$/
                var isPassword = /^\w{8,16}$/;
                return (isPassword.test(value))? undefined : `Mật khẩu phải từ 8-16 ký tự`;
                // return (isPassword.test(value) && !value.includes(test()))? undefined : `Mật khẩu phải từ 8-16 ký tự và không trùng với tên tài khoản`;
                // và phải chứa ít nhất 1 chữ số và ký tự đặc biệt, chữ hoa, chữ thường và không trùng tên người dùng
            }
        }
        }

        Validator.isRePassword = function(selector, testpassword){
        return {
            selector,
            test: function(value){
                return value === testpassword()? undefined : 'Xác nhận mật khẩu không trùng khớp';
            }
        }
        }

        Validator.isSalePrice = function(selector, testsaleprice){
        return {
            selector,
            test: function(value){
                if(value)
                return value < testsaleprice()? undefined : 'Giá sale phải bé hơn giá gốc';
            }
        }
        }

        Validator.isPhone = function(selector){
        return {
            selector,
            test: function(value){
                return /^\d{10,12}$/.test(value)? undefined : `Số điện thoại phải từ 10-12 số`;
            }
        }
        }

        Validator.isSaleEndTime = function(selector, test_sale_end_time){
        return {
            selector,
            test: function(value){
                if(value)
                return value > test_sale_end_time()? undefined : 'Thời gian kết thúc phải lớn hơn thời gian bắt đầu';
            }
        }
        }

        Validator.isSaleStartTime = function(selector, test_sale_start_time){
        return {
            selector,
            test: function(value){
                if(test_sale_start_time())
                return value < test_sale_start_time()? undefined : 'Thời gian bắt đầu phải bé hơn thời gian kết thúc';
            }
        }
        }
        
        Validator.isSaleEndTimeSysdate = function(selector){
        return {
            selector,
            test: function(value){
                var now = moment().format('YYYY-MM-DD HH:mm');
                return value > now? undefined : 'Thời gian kết thúc phải lớn hơn thời gian hiện tại';
            }
        }
        }
</script>
