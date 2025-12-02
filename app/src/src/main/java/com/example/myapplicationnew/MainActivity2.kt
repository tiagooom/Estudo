package com.example.myapplicationnew

import android.accessibilityservice.AccessibilityService
import android.content.Intent
import android.os.Bundle
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.compose.foundation.gestures.detectTapGestures
import androidx.compose.foundation.layout.*
import androidx.compose.material3.Button
import androidx.compose.material3.Text
import androidx.compose.runtime.*
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.input.pointer.pointerInput
import androidx.compose.ui.layout.positionOnScreen
import androidx.compose.ui.layout.onGloballyPositioned
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.unit.dp
import androidx.compose.ui.unit.sp

class MainActivity2 : ComponentActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        setContent {

            val lastX by CoordinatesHolder.lastX.collectAsState()
            val lastY by CoordinatesHolder.lastY.collectAsState()

            var captureEnabled by remember { mutableStateOf(false) }
            var boxOffsetX by remember { mutableStateOf(0f) }
            var boxOffsetY by remember { mutableStateOf(0f) }

            val targetX = 663
            val targetY = 1631
            val context = this@MainActivity2

            Box(
                modifier = Modifier
                    .fillMaxSize()
                    .onGloballyPositioned { layout ->
                        val pos = layout.positionOnScreen()
                        boxOffsetX = pos.x
                        boxOffsetY = pos.y
                    }
                    .pointerInput(captureEnabled) {
                        if (captureEnabled) {

                            detectTapGestures { offset ->

                                val realX = boxOffsetX + offset.x
                                val realY = boxOffsetY + offset.y

                                // 👉 Aqui sim é o lugar certo
                                CoordinatesHolder.update(realX, realY)
                            }
                        }
                    },
                contentAlignment = Alignment.Center
            ) {
                Column(
                    modifier = Modifier.fillMaxSize(),
                    horizontalAlignment = Alignment.CenterHorizontally,
                    verticalArrangement = Arrangement.Center
                ) {

                    Button(onClick = {
                        MyAccessibilityService.instance?.performGlobalAction(
                            AccessibilityService.GLOBAL_ACTION_HOME
                        )
                    }) {
                        Text("HOME")
                    }

                    Spacer(modifier = Modifier.height(20.dp))

                    Button(onClick = {
                        MyAccessibilityService.instance?.performGlobalAction(
                            AccessibilityService.GLOBAL_ACTION_BACK
                        )
                    }) {
                        Text("VOLTAR")
                    }

                    Spacer(modifier = Modifier.height(20.dp))

                    Button(onClick = { captureEnabled = !captureEnabled }) {
                        Text(if (captureEnabled) "DESATIVAR" else "PEGAR TOQUE")
                    }

                    Spacer(modifier = Modifier.height(40.dp))

                    Button(onClick = {
                        MyAccessibilityService.instance?.performGlobalAction(
                            AccessibilityService.GLOBAL_ACTION_HOME
                        )
                        MyAccessibilityService.instance?.postDelayed(1000) {
                            MyAccessibilityService.instance?.tap(targetX, targetY)
                        }
                    }) {
                        Text("BOTÃO HOME + CLICAR EM COORDENADA")
                    }

                    Spacer(modifier = Modifier.height(20.dp))

                    Button(onClick = {
                        // Abre apps recentes
                        MyAccessibilityService.instance?.performGlobalAction(
                            AccessibilityService.GLOBAL_ACTION_RECENTS
                        )

                        // Volta automaticamente para o último app
                        MyAccessibilityService.instance?.postDelayed(200) {
                            MyAccessibilityService.instance?.performGlobalAction(
                                AccessibilityService.GLOBAL_ACTION_RECENTS
                            )
                        }

                        // Agora espera o app abrir COMPLETAMENTE
                        MyAccessibilityService.instance?.postDelayed(700) {
                            val intent = Intent(context, TransparentOverlayActivity::class.java)
                            intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK)
                            context.startActivity(intent)
                        }
                    }) {
                        Text("Voltar + Overlay")
                    }


                    Spacer(modifier = Modifier.height(20.dp))

                    Button(onClick = {
                        MyAccessibilityService.instance?.performGlobalAction(
                            AccessibilityService.GLOBAL_ACTION_HOME
                        )
                        MyAccessibilityService.instance?.postDelayed(1000) {
                            MyAccessibilityService.instance?.tap(172, 697)
                        }

                        MyAccessibilityService.instance?.postDelayed(5000) {
                            MyAccessibilityService.instance?.tap(572, 2210)
                        }

                        MyAccessibilityService.instance?.postDelayed(6000) {
                            MyAccessibilityService.instance?.tap(236, 1230)
                        }

                        MyAccessibilityService.instance?.postDelayed(7000) {
                            MyAccessibilityService.instance?.tap(870, 1579)
                        }

                        MyAccessibilityService.instance?.postDelayed(8000) {
                            MyAccessibilityService.instance?.tap(894, 1244)
                        }

                        MyAccessibilityService.instance?.postDelayed(9000) {
                            MyAccessibilityService.instance?.tap(183, 1416)
                        }

                    }) {
                        Text("CLICAR EM CONJ DE COORDENADAS")
                    }

                    Spacer(modifier = Modifier.height(40.dp))

                    Button(onClick = {
                        val service = MyAccessibilityService.instance ?: return@Button

                        var t = 0L   // controla o tempo acumulado

                        // 1 - Abrir notificações (swipe topo → baixo)
                        service.postDelayed(t) {
                            service.swipe(
                                startX = 540,
                                startY = 10,
                                endX = 540,
                                endY = 1400,
                                duration = 300
                            )
                        }

                        // 2 - Ícone do gravador
                        t += 1000
                        service.postDelayed(t) { service.tap(410, 170) }

                        // 3 - Botão "Áudio"
                        t += 1000
                        service.postDelayed(t) { service.tap(732, 212) }

                        // 4 - Botão "Iniciar"
                        t += 1000
                        service.postDelayed(t) { service.tap(729, 378) }

                        // 🔴 AGUARDA 10s gravando
                        t += 6000

                        // 5 - Abrir notificações novamente
                        service.postDelayed(t) {
                            service.swipe(
                                startX = 540,
                                startY = 10,
                                endX = 540,
                                endY = 1400,
                                duration = 300
                            )
                        }

                        // 6 - Ícone do gravador → parar
                        t += 1000
                        service.postDelayed(t) { service.tap(410, 170) }

                        // 8 - Ícone gravador → iniciar
                        t += 5000
                        service.postDelayed(t) { service.tap(410, 170) }

                        // 4 - Botão "Iniciar confirmar"
                        t += 1000
                        service.postDelayed(t) { service.tap(729, 378) }

                        // 🔴 5s gravando novamente
                        t += 4000

                        // 9 - Abrir notificações
                        service.postDelayed(t) {
                            service.swipe(
                                startX = 540,
                                startY = 10,
                                endX = 540,
                                endY = 1400,
                                duration = 300
                            )
                        }

                        // 10 - Ícone gravador → finalizar
                        t += 1000
                        service.postDelayed(t) { service.tap(410, 170) }

                        // 11 - Limpar notificação
                        t += 2000
                        service.postDelayed(t) {
                            service.swipe(
                                startX = 200,
                                startY = 306,
                                endX = 600,
                                endY = 306,
                                duration = 300
                            )
                        }

                        t += 1200
                        service.postDelayed(t) {
                            service.performGlobalAction(
                                AccessibilityService.GLOBAL_ACTION_BACK
                            )
                        }

                    }) {
                        Text("ATIVAR GRAVADOR")
                    }



                    Spacer(modifier = Modifier.height(40.dp))

                    Button(onClick = {
                        val service = MyAccessibilityService.instance ?: return@Button

                        // Ir para Home
                        service.performGlobalAction(
                            AccessibilityService.GLOBAL_ACTION_HOME
                        )
                        service.postDelayed(1000) { service.tap(705, 756) }
                    }) {
                        Text("CLICAR NO TABLET FISICO")
                    }

                    Spacer(modifier = Modifier.height(40.dp))

                    Button(onClick = {
                        val service = MyAccessibilityService.instance ?: return@Button

                        var t = 0L

                        // 0 - Ir para Home imediatamente
                        service.performGlobalAction(
                            AccessibilityService.GLOBAL_ACTION_HOME
                        )

                        // 1 - abrir app
                        t += 1000
                        service.postDelayed(t) { service.tap(705, 756) }

                        // 2 - clicar na lupa
                        t += 2000
                        service.postDelayed(t) { service.tap(30, 516) }

                        // 3 - campo de pesquisa
                        t += 1000
                        service.postDelayed(t) { service.tap(169, 41) }

                        // 4 - nome
                        t += 1000
                        service.postDelayed(t) { service.tap(345, 155) }

                        // 5 - contas
                        t += 1000
                        service.postDelayed(t) { service.tap(299, 99) }

                        // 6 - foto
                        t += 1000
                        service.postDelayed(t) { service.tap(386, 159) }

                        // 7 - 3 pontos
                        t += 1000
                        service.postDelayed(t) { service.tap(772, 53) }

                        // 8 - desbloquear 1
                        t += 1000
                        service.postDelayed(t) { service.tap(522, 900) }

                        // 9 - desbloquear 2
                        t += 1000
                        service.postDelayed(t) { service.tap(502, 672) }

                        // 10 - confirmar desbloqueio
                        t += 1000
                        service.postDelayed(t) { service.tap(458, 682) }

                        // 11 - voltar
                        t += 1200
                        service.postDelayed(t) {
                            service.performGlobalAction(
                                AccessibilityService.GLOBAL_ACTION_BACK
                            )
                        }

                        // 12 - foto novamente
                        t += 1200
                        service.postDelayed(t) { service.tap(386, 159) }

                        // 14 - Abrir notificações (swipe topo → baixo)
                        t += 1000
                        service.postDelayed(t) {
                            service.swipe(540, 10, 540, 1400, 300)
                        }

                        // 15 - Ícone do gravador
                        t += 1000
                        service.postDelayed(t) { service.tap(410, 170) }

                        // 16 - Botão "Áudio"
                        t += 1000
                        service.postDelayed(t) { service.tap(732, 212) }

                        // 17 - Botão "Iniciar"
                        t += 1000
                        service.postDelayed(t) { service.tap(729, 378) }

                        // 13 - principal sz
                        t += 2500
                        service.postDelayed(t) { service.tap(188, 124) }

                        // Esperar a tela mudar para testar o QR code
                        t += 2000
                        service.postDelayed(t) {

                            val achou = service.procurarTextoNaTela("qr code")

                            //
                            // AGORA COMEÇA A TIMELINE INTERNA (tLocal)
                            //
                            var tLocal = 0L

                            if (!achou) {
                                // 18 – Gravando ~1min
                                tLocal += 75000

                                // 19 - Abrir notificações
                                service.postDelayed(tLocal) {
                                    service.swipe(540, 10, 540, 1400, 300)
                                }

                                // 20 - Parar gravação
                                tLocal += 1000
                                service.postDelayed(tLocal) { service.tap(410, 170) }

                                // 21 - Iniciar nova gravação
                                tLocal += 5000
                                service.postDelayed(tLocal) { service.tap(410, 170) }

                                // 22 - Confirmar Iniciar
                                tLocal += 1000
                                service.postDelayed(tLocal) { service.tap(729, 378) }

                            } else {
                                //
                                // QR CODE ACHADO → fluxo curto
                                //

                                // 23 - Gravando 1s
                                tLocal += 4000

                                // 24 - Abrir notificações
                                service.postDelayed(tLocal) {
                                    service.swipe(540, 10, 540, 1400, 300)
                                }

                                // 25 - Finalizar gravação
                                tLocal += 1000
                                service.postDelayed(tLocal) { service.tap(410, 170) }

                                // 26 - Limpar notificação
                                tLocal += 2000
                                service.postDelayed(tLocal) {
                                    service.swipe(
                                        startX = 200,
                                        startY = 306,
                                        endX = 600,
                                        endY = 306,
                                        duration = 300
                                    )
                                }

                                // 27 - Voltar
                                tLocal += 1200
                                service.postDelayed(tLocal) {
                                    service.performGlobalAction(
                                        AccessibilityService.GLOBAL_ACTION_BACK
                                    )
                                }

                                // 28 - 3 pontos novamente
                                tLocal += 1000
                                service.postDelayed(tLocal) { service.tap(772, 53) }

                                // 29 - bloquear
                                tLocal += 1500
                                service.postDelayed(tLocal) { service.tap(532, 906) }

                                // 30 - bloquear 2
                                tLocal += 1200
                                service.postDelayed(tLocal) { service.tap(580, 1137) }

                                // 31 - voltar
                                tLocal += 1000
                                service.postDelayed(tLocal) {
                                    service.performGlobalAction(
                                        AccessibilityService.GLOBAL_ACTION_BACK
                                    )
                                }

                                // 32 - voltar novamente
                                tLocal += 1000
                                service.postDelayed(tLocal) {
                                    service.performGlobalAction(
                                        AccessibilityService.GLOBAL_ACTION_BACK
                                    )
                                }

                                // 33 - campo de pesquisa
                                tLocal += 1000
                                service.postDelayed(tLocal) { service.tap(169, 41) }

                                // 34 - excluir pesquisa
                                tLocal += 800
                                service.postDelayed(tLocal) { service.tap(776, 144) }

                                // 35 - abrir apps recentes
                                tLocal += 1000
                                service.postDelayed(tLocal) {
                                    service.performGlobalAction(
                                        AccessibilityService.GLOBAL_ACTION_RECENTS
                                    )
                                }

                                // 36 - arrastar app pra cima para fechar
                                tLocal += 1700
                                service.postDelayed(tLocal) {
                                    service.swipe(
                                        startX = 540,
                                        startY = 900,
                                        endX = 540,
                                        endY = 200,
                                        duration = 300
                                    )
                                }

                                // 37 - voltar para Home
                                tLocal += 1400
                                service.postDelayed(tLocal) {
                                    service.performGlobalAction(
                                        AccessibilityService.GLOBAL_ACTION_HOME
                                    )
                                }

                                // 38 - swipe tela Home (esquerda → direita)
                                tLocal += 1800
                                service.postDelayed(tLocal) {
                                    service.swipe(
                                        startX = 150,
                                        startY = 1000,
                                        endX = 900,
                                        endY = 1000,
                                        duration = 300
                                    )
                                }
                            }
                        }

                    }) {
                        Text("CONJ COORD NO TABLET FISICO")
                    }


                    Spacer(modifier = Modifier.height(40.dp))

                    Text(
                        text = "X: ${lastX.toInt()}\nY: ${lastY.toInt()}",
                        fontSize = 40.sp,
                        fontWeight = FontWeight.Bold
                    )
                }
            }
        }
    }
}
