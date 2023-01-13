<x-dashboard.layout>
    <section class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">Form Product</h4>
                        <p>Enter your data product in form bellow</p>

                        <form class="form form-vertical mt-4" method="POST">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="first-name-vertical">Product Name</label>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Product Name">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="email-id-vertical">Quantity</label>
                                            <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="contact-info-vertical">Price Per Item</label>
                                            <input type="number" class="form-control" name="price" id="price" placeholder="Price per item">
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                        <button id="reset" type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">Datra Products</h4>
                        <p>Here is data that you have submitted</p>

                        <table class="table" id="table-product">
                            <thead>
                                <tr>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price Per Item</th>
                                    <th scope="col">Date Time Submitted</th>
                                    <th scope="col">Total Value Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $totalValueNumber = 0;
                                @endphp
                                @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->date_time }}</td>
                                    <td>{{ $product->price*$product->quantity }}</td>
                                </tr>
                                @php
                                $totalValueNumber +=$product->price*$product->quantity;
                                @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3"></th>
                                    <th>Total Value Number</th>
                                    <th id="value-number">{{ $totalValueNumber }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>


    </section>



    @section("custom-scripts")
    @vite("resources/js/pages/product")
    @endsection
</x-dashboard.layout>
