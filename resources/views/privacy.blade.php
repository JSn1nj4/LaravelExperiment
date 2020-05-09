@extends('layouts.page')

@section('content')

  <section class="pt-4">
    <div class="container mx-auto px-4 pt6">
      <h1 class="content-title text-4xl">Privacy Policy</h1>

      <h2 class="content-title text-3xl">h2</h2>
      <h3 class="content-title text-2xl">h3</h3>
      <h4 class="content-title text-xl">h4</h4>

      <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

      <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

      <ul class="mb-4 pl-8 list-disc">
        <li>List item
          <ul class="mb-4 pl-5 list-circle">
            <li>sub list item</li>
            <li>sub list item</li>
            <li>sub list item
              <ul class="mb-4 pl-5 list-plus">
                <li>sub sub list item</li>
                <li>sub sub list item</li>
                <li>sub sub list item</li>
                <li>sub sub list item</li>
                <li>sub sub list item</li>
              </ul>
            </li>
            <li>sub list item
              <ul class="mb-4 pl-5 list-dash">
                <li>sub sub list item</li>
                <li>sub sub list item</li>
                <li>sub sub list item</li>
                <li>sub sub list item</li>
                <li>sub sub list item</li>
              </ul>
            </li>
          </ul>
        </li>
        <li>list item</li>
      </ul>
      <ol class="mb-4 pl-8 list-decimal">
        <li>Ordered list item</li>
        <li>Ordered list item</li>
        <li>Ordered list item</li>
      </ol>
      <ol class="mb-4 pl-8 list-lower-roman">
        <li>Ordered list item</li>
        <li>Ordered list item</li>
        <li>Ordered list item</li>
      </ol>
      <ol class="mb-4 pl-8 list-upper-roman">
        <li>Ordered list item</li>
        <li>Ordered list item</li>
        <li>Ordered list item</li>
      </ol>
      <ol class="mb-4 pl-8 list-lower-alpha">
        <li>Ordered list item</li>
        <li>Ordered list item</li>
        <li>Ordered list item</li>
      </ol>
      <ol class="mb-4 pl-8 list-upper-alpha">
        <li>Ordered list item</li>
        <li>Ordered list item</li>
        <li>Ordered list item</li>
      </ol>
    </div>
  </section>

@endsection
