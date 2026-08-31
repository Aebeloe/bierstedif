import { usePage } from '@inertiajs/vue3';
import { computed, type ComputedRef } from 'vue';

export interface NavChild {
    label: string;
    href: string;
    external?: boolean;
}

export interface NavItem {
    label: string;
    href: string;
    children?: NavChild[];
}

export function useNavigation(): ComputedRef<NavItem[]> {
    const page = usePage<{ mosefestenVisible: boolean }>();

    return computed(() => {
        const mosefestenVisible = page.props.mosefestenVisible;

        return [
            {
                label: 'Udvalg',
                href: '#',
                children: [
                    { label: 'Biersted Nyt', href: '/udvalg/biersted-nyt' },
                    { label: 'TUEN', href: '/udvalg/tuen' },
                    { label: 'Eventudvalget', href: '/udvalg/eventudvalget' },
                    { label: 'Hjælperbank', href: '/udvalg/hjaelperbank' },
                    { label: 'Booking', href: '/udvalg/booking' },
                ],
            },
            {
                label: 'Tilmeldinger',
                href: '#',
                children: [
                    { label: 'Prøvetræning', href: '/tilmeldinger/proevetraening' },
                    { label: 'Badminton', href: '/tilmeldinger/badminton' },
                    { label: 'Fodbold', href: '/tilmeldinger/fodbold' },
                    { label: 'Gymnastik', href: '/tilmeldinger/gymnastik' },
                    { label: 'Håndbold', href: '/tilmeldinger/haandbold' },
                    { label: 'Floorball', href: '/tilmeldinger/floorball' },
                    { label: 'Dart', href: '/tilmeldinger/dart' },
                    { label: 'Esport', href: '/tilmeldinger/esport' },
                    { label: 'Familiemedlemskab', href: '/tilmeldinger/familiemedlemskab' },
                    { label: 'Ungdomsklub', href: '/tilmeldinger/ungdomsklub' },
                    { label: 'Øvrige Hold', href: '/tilmeldinger/oevrige-hold' },
                    ...(mosefestenVisible ? [{ label: 'Mosefesten', href: '/tilmeldinger/mosefesten' }] : []),
                    { label: 'Login', href: '/tilmeldinger/login' },
                ],
            },
            { label: 'Om Foreningen', href: '/om-foreningen' },
            { label: 'Kalender', href: '/kalender' },
            { label: 'Kontakt', href: '/kontakt' },
            { label: 'Webshop', href: '/klubdragt' },
            { label: 'Sponsorer', href: '/sponsorer' },
        ];
    });
}
