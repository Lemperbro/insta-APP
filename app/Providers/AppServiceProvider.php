<?php

namespace App\Providers;

use TallStackUi\Facades\TallStackUi;
use Illuminate\Support\ServiceProvider;
use Opcodes\LogViewer\Facades\LogViewer;
use App\Providers\TelescopeServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->softPersonalizationTallstackUi();
        if (config('app.env') !== 'local') {
            $this->authorizationLogViewer();
        }
    }

    private function authorizationLogViewer()
    {
        LogViewer::auth(function ($request) {
            return $request->user()
                && in_array($request->user()->email, [
                    'yuliantoryan64@gmail.com',
                ]);
        });
    }


    private function softPersonalizationTallstackUi()
    {
        TallStackUi::personalize('modal')
            ->block('wrapper.first', 'fixed inset-0 bg-[var(--bg-4)]/70 transform transition-opacity')
            ->block('wrapper.second', 'fixed inset-0 z-50 w-screen overflow-y-auto')
            ->block('wrapper.third', 'mx-auto flex min-h-full w-full transform justify-center p-4')
            ->block('wrapper.fourth', 'bg-[var(--bg-1)]  flex w-full transform flex-col rounded-xl  text-left shadow-xl transition-all')
            ->block('title.wrapper', 'dark:border-b-[var(--border)] flex items-center justify-between border-b px-4 py-2.5')
            ->block('footer', 'dark:text-dark-300 dark:border-t-[var(--border)] flex justify-end gap-2 rounded-b-xl border-t p-4 text-gray-700')
            ->block('body', 'text-[var(--fg-2)]  py-5  px-4');

        TallStackUi::personalize('floating')
            ->block('wrapper', 'bg-[var(--input)] border-dark-200 dark:border-dark-600 !fixed !z-[99] rounded-lg border !left-0 !right-0');

        TallStackUi::personalize('select.styled')
            ->block('floating.default', 'bg-[var(--input)] border-dark-200 dark:border-dark-600 !fixed !z-[99] rounded-lg border !left-0 !right-0')
            ->block('items.wrapper', 'truncate flex gap-2 flex-wrap')
            ->block('input.wrapper.base')
            ->replace('dark:bg-dark-800', 'bg-[var(--input)]')
            ->replace('bg-white', 'bg-[var(--input)]');

        // TallStackUi::personalize()
        //     ->form('input')
        //     ->block('input.color.base', 'ring-[var(--border)] text-[var(--fg-2)]')
        //     ->block('input.color.background', 'bg-[var(--input)] ring-[var(--ring)] text-[var(--input-fg)]')
        //     ->block('input.wrapper', 'flex rounded-md ring-1 !ring-[var(--border)] focus-within:ring-2 focus-within:!ring-[var(--ring)] focus-within:focus:ring-[var(--ring)] focus:ring-[var(--ring)] !shadow-none');

        TallStackUi::personalize('slide')
            ->block('wrapper.first', 'fixed inset-0 bg-[var(--bg-4)]/70 transform transition-opacity')
            ->block('header', 'px-4 pb-4 border-b')
            ->block('wrapper.fifth', 'flex flex-col bg-[var(--bg-1)] py-6 shadow-xl');

        TallStackUi::personalize('form.upload')
            ->block('preview.backdrop', 'fixed left-0 top-0 z-50 flex h-full w-full items-center justify-center bg-[var(--bg-4)]/70');

        TallStackUi::personalize('dialog')
            ->block('wrapper.third', 'relative w-full max-w-sm transform overflow-hidden bg-[var(--bg-1)] rounded-xl p-4 text-left shadow-xl transition-all sm:my-8 ')
            ->block('background', 'fixed inset-0 bg-[var(--bg-4)]/70 transform transition-opacity');
    }
}
