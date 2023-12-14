<li class="nav-item" id="menu_table">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-table"></i>
        <p>
            {{__('t.Table')}}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview ml-2">
        <div class="dropdown-divider"></div>
        <!-- <li class="nav-item">
            <a href="" class="nav-link text-yellow">
                <h5 class=""> {{__('Option 01')}}</h5>
            </a>
        </li> -->

        <li class="nav-item">
            <a href="{{route('delegation.index')}}" class=" nav-link" id="menu_delegation">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Delegation')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('delegation.role.index')}}" class=" nav-link" id="menu_delegation_role">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.delegation role')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit_type.index')}}" class=" nav-link" id="menu_audit_type">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Audit Type')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit_category.index')}}" class=" nav-link" id="menu_audit_category">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Audit Category')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit_time.index')}}" class=" nav-link" id="menu_audit_time">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Audit Time')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit_stds.index')}}" class=" nav-link" id="menu_audit_std">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Audit std')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit_status.index')}}" class=" nav-link" id="menu_audit_status">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Audit_Status')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit_process_status.index')}}" class=" nav-link" id="menu_auditprocessstatus">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Audit Process Status')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit_step.index')}}" class=" nav-link" id="menu_audit_step">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Audit Step')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit_qc.index')}}" class=" nav-link" id="menu_audit_qc">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Audit QC')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit_qa.index')}}" class=" nav-link" id="menu_audit_qa">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Audit QA')}}</p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{route('domain.index')}}" class=" nav-link" id="menu_domain">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Domain')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit.report.pfm.index')}}" class=" nav-link" id="menu_Audit_Report_PFM">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Audit Report PFM')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('auditee.type.index')}}" class=" nav-link" id="menu_auditee_type">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Auditee type')}}</p>
            </a>
        </li>
        <li class=" nav-item">
            <a href="{{route('auditee.person.index')}}" class=" nav-link" id="menu_auditee_person">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Auditee Person')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('auditee.contact.type.index')}}" class=" nav-link" id="menu_auditee_contact_type">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Auditee Contact Type')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('auditee.person.type.index')}}" class=" nav-link" id="menu_auditee_person_type">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Auditee Person Type')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('client.type.index')}}" class=" nav-link" id="menu_client_type">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Client type')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('client.person.index')}}" class=" nav-link" id="menu_client_person">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Client Person')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('client.contact.type.index')}}" class=" nav-link" id="menu_client_contact_type">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Client Contact Type')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('client.person.type.index')}}" class=" nav-link" id="Client_Person_Type">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-blue">{{__('t.Client Person Type')}}</p>
            </a>
        </li>



        <!-- ////////////////// -->
        <div class="dropdown-divider"></div>
        <!-- <li class="nav-item">
            <a href="" class="nav-link text-yellow">
                <h5 class=""> {{__('t.Option 02')}}</h5>
            </a>
        </li> -->

        <li class="nav-item">
            <a href="{{route('audit.index')}}" class=" nav-link" id="menu_audit">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('t.Audit')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('delegation.team.index')}}" class=" nav-link" id="menu_delegation_team">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('t.Delegation Team')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('unit.index')}}" class=" nav-link" id="menu_unit">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('t.unit')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit.tracking.index')}}" class=" nav-link" id="menu_audit_tracking">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('t.Audit Tracking')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit.qc.review.index')}}" class=" nav-link" id="menu_audit_qc_review">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('t.Audit QC Review')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit.qa.review.index')}}" class=" nav-link" id="menu_audit_qa_review">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('t.Audit QA Review')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit.domain.index')}}" class=" nav-link" id="menu_audit_domain_index">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('t.Audit Domain')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('audit.pfm.index')}}" class=" nav-link" id="menu_audit_pfm">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('t.Audit PFM')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('auditee.index')}}" class=" nav-link" id="menu_auditee">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('Auditee')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('auditee.person.contact.index')}}" class=" nav-link" id="menu_auditee_person_contact">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('t.Auditee Person Contact')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('auditee.organization.contact.index')}}" class=" nav-link"
                id="menu_auditee_organization_contact">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('t.Auditee Organization Contact')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('client.index')}}" class=" nav-link" id="menu_client">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('t.Client')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('client.person.contact.index')}}" class=" nav-link" id="menu_client_person_contact">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('t.Client Person Contact')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('client.organization.contact.index')}}" class=" nav-link"
                id="menu_client_organization_contact">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('t.Client Organization Contact')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('client.auditee.index')}}" class=" nav-link" id="menu_client_auditee">
                <i class="fa fa-table nav-icon"></i>
                <p class="text-yellow">{{__('t.Client Auditee')}}</p>
            </a>
        </li>

        <!-- //////////////////////////// -->
        <div class="dropdown-divider"></div>

        <!-- <li class="nav-item">
            <a href="" class=" nav-link" id="">
                <i class="far fa-circle nav-icon"></i>
                <p class="text-red">(29)Auditee_Client_type</p>
            </a>
        </li> -->
    </ul>
</li>