<div>

    @if ($catchError)
        <div class="alert alert-danger" id="success-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $catchError }}
        </div>
    @endif

    @if ($InvoiceSaved)
        <div class="alert alert-info">تم حفظ البيانات بنجاح.</div>
    @endif

    @if ($InvoiceUpdated)
        <div class="alert alert-info">تم تعديل البيانات بنجاح.</div>
    @endif

    @if ($show_table)

        @include('livewire.single_invoices.Table')
    @else
        <form wire:submit.prevent="store" autocomplete="off">
            @csrf
            <div class="row">
                <div class="col">
                    <label>اسم المريض</label>
                    <select wire:model="patient_id" class="form-control" id="patient_id" required>
                        <option value="">-- اختار من القائمة --</option>
                        @foreach ($Patients as $Patient)
                            <option value="{{ $Patient->id }}">{{ $Patient->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col">
                    <label>اسم الدكتور</label>
                    <select wire:model="doctor_id" wire:change="get_section" class="form-control" id="doctor_id"
                        required>
                        <option value="">-- اختار من القائمة --</option>
                        @foreach ($Doctors as $Doctor)
                            <option value="{{ $Doctor->id }}">{{ $Doctor->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col">
                    <label>القسم</label>
                    <input wire:model="section_id" type="text" class="form-control" id="section_id" readonly>
                </div>

                <div class="col">
                    <label>نوع الفاتورة</label>
                    <select wire:model="type" class="form-control" {{ $updateMode == true ? 'disabled' : '' }}>
                        <option value="">-- اختار من القائمة --</option>
                        <option value="1">نقدي</option>
                        <option value="2">اجل</option>
                    </select>
                </div>


            </div><br>

            <div class="row row-sm">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title mg-b-0"></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mg-b-0 text-md-nowrap" style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم الخدمة</th>
                                            <th>سعر الخدمة</th>
                                            <th>قيمة الخصم</th>
                                            <th>نسبة الضريبة</th>
                                            <th>قيمة الضريبة</th>
                                            <th>الاجمالي مع الضريبة</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>

                                                <select wire:model="Service_id" class="form-control"
                                                    wire:change="get_price" id="service_id">

                                                    <option value="">-- اختار الخدمة --</option>
                                                    @foreach ($Services as $Service)
                                                        <option value="{{ $Service->id }}">{{ $Service->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input wire:model="price" type="text" class="form-control"
                                                    id="price" readonly>
                                            </td>
                                            <td><input wire:model="discount_value" type="text" id="discount_value"
                                                    class="form-control">
                                            </td>
                                            <th><input wire:model="tax_rate" type="text" id="tax_rate"
                                                    class="form-control"></th>
                                            <td><input type="text" class="form-control" value="{{ $tax_value }}"
                                                    readonly></td>
                                            <td><input type="text" class="form-control" readonly
                                                    value="{{ $subtotal + $tax_value }}"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!-- bd -->
                        </div><!-- bd -->
                    </div><!-- bd -->
                </div>
            </div>

            <input class="btn btn-outline-success" type="submit" value="تاكيد البيانات">
        </form>

    @endif


</div>
