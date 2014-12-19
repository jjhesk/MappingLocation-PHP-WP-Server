<form id="input_new_cr" class="row-fluid fieldset step2" style="display:none">
    <h2>{new company name is here}</h2>

    <h3>請輸入至少一個公司代表登錄資料 Please enter at least one CR data for the system.</h3>

    <div class="row-fluid">
        <div class="span4 fieldlabel">
            <label for="cr_name">姓名 Name</label>
        </div>
        <div class="span8 fieldinputs">
            <input name="cr_name" type="text"/>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span4 fieldlabel">
            <label for="cr_phone">電話號碼 Phone Number</label>
        </div>
        <div class="span8 fieldinputs">
            <input name="cr_phone" type="number"/>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span4 fieldlabel">
            <label for="cr_email">聯繫電子郵件 Contact email</label>
        </div>
        <div class="span8 fieldinputs">
            <input name="cr_email" type="email"/>
        </div>
    </div>
    <input name="company_name" type="hidden" value=""/>
    <button id="addcr" class="">
        創建一個新的公司代表 Create a New Company Representative
    </button>
</form>
<form class="step2">
    <ul id="new_cr_registration">
        <!-- The services will be inserted here -->
    </ul>
    <div id="cr_registration_note">

    </div>
    <button id="cr_registration_done" class="submit" style="display:none">提交代表名單 Submitted the list of Representatives</button>
</form>
<form class="step3" style="display:none">
    <div id="cr_registration_notification">
        Your company application is now pending for approval process. Once the pending application is approved your
        company representative will receive an email notification for the new account.
        你的公司申請，現正等待審批過程。一旦掛起的申請被批准你公司的代表將收到一封電子郵件通知新帳戶。
    </div>
    <button id="cr_registration_notification_done" class="submit aligncenter">Confirm</button>
</form>
<script id="crtemplate" type="text/x-handlebars-template">
    <li class="datastack row">
        <div class="span7">
            <div class="row-fluid">
                <div class="span4 fieldlabel">
                    姓名 Name
                </div>
                <div data-field="{{cr_name}}" class="span8 fieldinputs input_cr_name">
                    {{cr_name}}
                </div>
            </div>
            <div class="row-fluid">
                <div class="span4 fieldlabel">
                    電話號碼 Phone Number
                </div>
                <div data-field="{{cr_phone}}" class="span8 fieldinputs input_cr_phone">
                    {{cr_phone}}
                </div>
            </div>
            <div class="row-fluid">
                <div class="span4 fieldlabel">
                    聯繫電子郵件 Contact email
                </div>
                <div data-field="{{cr_email}}" class="span8 fieldinputs input_cr_email">
                    {{cr_email}}
                </div>
            </div>
        </div>
        <div class="span3 pull-right">
            <a class="destroybut"></a>
        </div>
    </li>
</script>
