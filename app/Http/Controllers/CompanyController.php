<?php

namespace App\Http\Controllers;

use App\Models\Company;

use Illuminate\View\View;
use Illuminate\Http\Request;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    public function index(): View
    {
        $companies = Company::all();
 
        return view('companies.index', compact('companies'));
    }

    public function create(): View
    {
        return view('companies.create');
    }
 
    public function store(StoreCompanyRequest $request)
    {
        Company::create($request->validated());
 
        return redirect()->route('companies.index');
    }
 
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }
 
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
 
        return redirect()->route('companies.index');
    }

    public function destroy(Company $company)
    {
        $company->delete();
 
        return redirect()->route('companies.index');
    }
}
