<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', fn() => Inertia::render('Home'))->name('home');
Route::get('/portfolio', fn() => Inertia::render('Portfolio'))->name('portfolio');
Route::get('/about', fn() => Inertia::render('About'))->name('about');
Route::get('/services', fn() => Inertia::render('Services'))->name('services');
Route::get('/contact', fn() => Inertia::render('Contact'))->name('contact');
